<?php

namespace common\models;

use common\components\CustomFunc;
use Yii;

/**
 * This is the model class for table "request_balance".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $create_at
 * @property float|null $amount
 */
class RequestBalance extends \common\models\BaseModel
{
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const statusArray = [
        self::STATUS_PENDING=>"بانتظار الرد",
        self::STATUS_APPROVED=>"تم اضافتها",
        self::STATUS_REJECTED=>"تم رفضها",
    ];
    public  function getStatusText(){
        return self::statusArray[$this->status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_balance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['amount'], 'number'],
        ];
    }
    public function fields()
    {
        return [
            'id',
            'balance' => function ($model) {
                return $model->amount;
            },
            'status' => function ($model) {
                return $model->getStatusText();
            },
            'time' => function ($model) {
                return $model->create_at;
            },

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RequestBalanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RequestBalanceQuery(get_called_class());
    }
}
