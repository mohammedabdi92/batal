<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sup_category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $main_cat_id
 * @property int|null $status
 * @property string|null $image_name
 */
class SupCategory extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sup_category';
    }

    public function fields()
    {
        return [
            'id','title',
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
            [['main_cat_id', 'status'], 'integer'],
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
            'main_cat_id' => Yii::t('app', 'Main Cat ID'),
            'status' => Yii::t('app', 'Status'),
            'image_name' => Yii::t('app', 'Image Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SupCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SupCategoryQuery(get_called_class());
    }
}
