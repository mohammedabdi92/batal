<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int|null $card_id
 * @property float|null $user_id
 * @property string|null $reservation_date
 * @property string|null $serial_number
 * @property int|null $status
 */
class Stock extends \yii\db\ActiveRecord
{
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
            [['reservation_date'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'card_id' => Yii::t('app', 'Card ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'reservation_date' => Yii::t('app', 'Reservation Date'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'status' => Yii::t('app', 'Status'),
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
}
