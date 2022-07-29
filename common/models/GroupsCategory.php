<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups_category".
 *
 * @property int $id
 * @property int|null $groups_id
 * @property int|null $main_category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $created_by
 */
class GroupsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groups_id', 'main_category_id', 'created_at', 'updated_at', 'updated_by', 'created_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'groups_id' => Yii::t('app', 'Groups ID'),
            'main_category_id' => Yii::t('app', 'القائمة الرئيسية'),
            'created_at' => Yii::t('app', 'تاريخ الانشاء'),
            'created_by' => Yii::t('app', 'المونشيء'),
            'updated_at' => Yii::t('app', 'تاريخ التعديل'),
            'updated_by' => Yii::t('app', 'اخر معدل'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GroupsCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupsCategoryQuery(get_called_class());
    }
}
