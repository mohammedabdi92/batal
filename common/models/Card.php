<?php

namespace common\models;

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
 * @property string|null $image_name
 */
class Card extends \yii\db\ActiveRecord
{
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
            'id','title','price',
            'count' => function ($model) {
                return 5;
            },
            'image_url' => function ($model) {
                return $this->image_name;
            },
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sup_cat_id', 'status'], 'integer'],
            [['price', 'category'], 'number'],
            [['title', 'image_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'sup_cat_id' => Yii::t('app', 'Sup Cat ID'),
            'price' => Yii::t('app', 'Price'),
            'category' => Yii::t('app', 'Category'),
            'status' => Yii::t('app', 'Status'),
            'image_name' => Yii::t('app', 'Image Name'),
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
}
