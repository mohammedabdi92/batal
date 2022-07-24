<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $created_by
 */
class Groups extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const statusArray = [
        self::STATUS_DELETED=>"محذوف",
        self::STATUS_INACTIVE=>"غير فعال",
        self::STATUS_ACTIVE=>"فعال",
    ];
    public  function getStatusText(){
        return self::statusArray[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'updated_by', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'الرقم'),
            'name' => Yii::t('app', 'الاسم'),
            'status' => Yii::t('app', 'الحالة'),
            'created_at' => Yii::t('app', 'تاريخ الانشاء'),
            'updated_at' => Yii::t('app', 'تاريخ التعديل'),
            'updated_by' => Yii::t('app', 'اخر معدل'),
            'created_by' => Yii::t('app', 'المنشئ'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupsQuery(get_called_class());
    }

    public function getCategories(){
        return $this->hasMany(GroupsCategory::className(), ['groups_id' => 'id']);
    }
}
