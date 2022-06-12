<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $status
 * @property string|null $image_name
 */
class MainCategory extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return 'main_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
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
            'status' => Yii::t('app', 'Status'),
            'image_name' => Yii::t('app', 'Image Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MainCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MainCategoryQuery(get_called_class());
    }
}
