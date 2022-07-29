<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "card_prices".
 *
 * @property int $id
 * @property int|null $card_id
 * @property int|null $groups_id
 * @property float|null $price
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $created_by
 */
class CardPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'groups_id', 'created_at', 'updated_at', 'updated_by', 'created_by'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'card_id' => Yii::t('app', 'اسم البطاقة'),
            'groups_id' => Yii::t('app', 'Groups ID'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'تاريخ الانشاء'),
            'created_by' => Yii::t('app', 'المونشيء'),
            'updated_at' => Yii::t('app', 'تاريخ التعديل'),
            'updated_by' => Yii::t('app', 'اخر معدل'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CardPricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CardPricesQuery(get_called_class());
    }
}
