<?php

namespace common\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $sup_cat_id
 * @property float|null $price
 * @property float|null $category
 * @property int|null $status
 * @property int|null $minimum_count
 * @property int $count
 * @property string|null $image_name
 */
class Card extends BaseModel
{
    public $prices = [];
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const statusArray = [
        self::STATUS_DELETED => "غير فعال",
        self::STATUS_ACTIVE => "فعال",
    ];

    public function getStatusText()
    {
        return self::statusArray[$this->status];
    }

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    public function fields()
    {
        return [
            'id', 'title','price' => function ($model) {
                $user =  \Yii::$app->user->identity;
                $priceModel = CardPrices::find()->where(['card_id' => $this->id, 'groups_id' => $user->group_id])->one();
                return $priceModel->price ?? '';
            },
            'count' => function ($model) {
                return 5;
            },
            'image_url' => function ($model) {
                return $this->getImageUrl();
            },
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => !$this->isNewRecord, 'extensions' => 'png, jpg, jpeg'],
            [['sup_cat_id', 'status'], 'integer'],
            [['price', 'category'], 'number'],
            [['title', 'image_name'], 'string', 'max' => 255],
            ['minimum_count', 'default', 'value' => 0],
            [['prices'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'الرقم'),
            'title' => Yii::t('app', 'اسم البطاقة'),
            'price' => Yii::t('app', 'سعر التكلفة'),
            'category' => Yii::t('app', 'فئة البطاقة'),
            'sup_cat_id' => Yii::t('app', 'القائمة الفرعية'),
            'status' => Yii::t('app', 'الحالة'),
            'count' => Yii::t('app', 'العدد المتوفر'),
            'image_name' => Yii::t('app', 'الصورة '),
            'imageFile' => Yii::t('app', 'الصورة '),
            'minimum_count' => Yii::t('app', 'حد التنبيه'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CardQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CardQuery(get_called_class());
    }

    public function afterFind()
    {
        $prices = [];
        foreach ($this->cardPrices as $price) {
            $prices[$price->groups_id] = $price->price;
        }
        $this->prices = $prices;
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        foreach ($this->prices as $key => $price) {
            $priceModel = CardPrices::find()->where(['card_id' => $this->id, 'groups_id' => $key])->one();
            if (!$priceModel) {
                $priceModel = new CardPrices();
            }
            $priceModel->price = $price;
            $priceModel->card_id = $this->id;
            $priceModel->groups_id = $key;
            $priceModel->save(false);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }


    public function upload()
    {
        if ($this->validate()) {

            if (!empty($this->imageFile)) {
                $dir = dirname(dirname(__DIR__)) . '/api' . '/web/uploads/card';
                if (!file_exists($dir)) {
                    mkdir("$dir", 0777, true);
                }
                $this->imageFile->saveAs($dir . '/' . $this->id . '-' . time() . '.' . $this->imageFile->extension);
                $this->image_name = $this->id . '-' . time() . '.' . $this->imageFile->extension;
                $this->save(false);
            }
            return true;
        } else {
            return false;
        }
    }

    public function getImageUrl()
    {
        return $this->image_name ? Yii::$app->params['api_url'] . 'uploads/card/' . $this->image_name : null;
    }

    public function getSup()
    {
        return $this->hasOne(SupCategory::className(), ['id' => 'sup_cat_id']);
    }

    public function getSupTitle()
    {
        return $this->sup ? $this->sup->title : '';
    }

    public function getCardPrices()
    {
        return $this->hasMany(CardPrices::className(), ['card_id' => 'id']);
    }
}
