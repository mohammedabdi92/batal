<?php

namespace common\models;

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
class RequestBalance extends \yii\db\ActiveRecord
{
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
