<?php

namespace common\models;

use common\components\CustomFunc;
use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int|null $card_id
 * @property float|null $user_id
 * @property string|null $reservation_date
 * @property string|null $serial_number
 * @property string|null $code
 * @property int|null $status
 */
class Stock extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PAYED = 2;
    const statusArray = [
        self::STATUS_DELETED=>"غير فعال",
        self::STATUS_ACTIVE=>"متاح",
        self::STATUS_PAYED=>"مباع",
    ];
    const editeStatusArray = [
        self::STATUS_DELETED=>"غير فعال",
        self::STATUS_ACTIVE=>"متاح",
    ];
    public  function getStatusText(){
        return self::statusArray[$this->status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'status'], 'integer'],
            [['user_id'], 'number'],
            [['code'],'required'],
            [['reservation_date'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
        ];
    }

    public function fields()
    {
        return [
            'card_name'=> function ($model) {
                return $this->getCardTitle();
            },
            'category'=> function ($model) {
                return $this->getCategory();
            },
            'code',
            'serial_number',
            'reservation_date',
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            Card::updateAllCounters(['count'=>1],['id'=>$this->card_id]);
        }else{
            Card::updateAllCounters(['count'=>1],['id'=>$this->card_id]);
            Card::updateAllCounters(['count'=>-1],['id'=>$this->getOldAttribute('card_id')]);
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'الرقم'),
            'card_id' => Yii::t('app', 'اسم البطاقة'),
            'user_id' => Yii::t('app', 'المشتري'),
            'reservation_date' => Yii::t('app', 'وقت الحجز'),
            'serial_number' => Yii::t('app', 'الرقم التسلسلي'),
            'code' => Yii::t('app', 'رمز البطاقة'),
            'status' => Yii::t('app', 'الحالة'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\StockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StockQuery(get_called_class());
    }
    public  function getCard(){
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    public  function getCardTitle(){
        return $this->card?$this->card->title:'';
    }
    public  function getCategory(){
        return $this->card?$this->card->category:'';
    }
}
