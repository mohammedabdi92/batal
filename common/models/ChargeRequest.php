<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "charge_request".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $fields_type
 * @property string|null $field_name
 * @property string|null $field_email
 * @property string|null $field_password
 * @property string|null $field_id
 * @property string|null $field_phone_number
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property int|null $card_id
 * @property int|null $stock_id
 * @property float|null $amount
 */
class ChargeRequest extends BaseModel
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
    const FIELDS_TYPE_USER_PASSWORD = 1;
    const FIELDS_TYPE_EMIAL_PASSWORD = 2;
    const FIELDS_TYPE_PHONE = 3;
    const FIELDS_TYPE_ID = 4;
    const fieldsTypeArray = [
        self::FIELDS_TYPE_USER_PASSWORD=>"اسم المستخدم وكلمة المرور",
        self::FIELDS_TYPE_EMIAL_PASSWORD=>"اسم المستخدم والايميل",
        self::FIELDS_TYPE_PHONE=>"رقم التلفون",
        self::FIELDS_TYPE_ID=>"الID",
    ];
    public  function fieldsTypeText(){
        return self::fieldsTypeArray[$this->fields_type];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'charge_request';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'fields_type', 'created_at', 'updated_at', 'updated_by', 'created_by', 'card_id', 'stock_id'], 'integer'],
            [['field_name', 'field_email', 'field_password', 'field_id', 'field_phone_number'], 'string'],
            [['amount'], 'number'],
            ['status', 'default', 'value' => self::STATUS_PENDING],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'المستخدم'),
            'status' => Yii::t('app', 'الحالة'),
            'fields_type' => Yii::t('app', 'نوع ادخال الطلب '),
            'field_name' => Yii::t('app', ' اسم المستخدم المدخل'),
            'field_email' => Yii::t('app', 'ايميل المدخل'),
            'field_password' => Yii::t('app', 'الباسورد المدخل'),
            'field_id' => Yii::t('app', 'الid المدخل'),
            'field_phone_number' => Yii::t('app', 'رقم التلفون المدخل'),
            'created_at' => Yii::t('app', 'تاريخ الانشاء'),
            'updated_at' => Yii::t('app', 'تاريخ التعديل'),
            'updated_by' => Yii::t('app', 'اخر معدل'),
            'created_by' => Yii::t('app', 'المنشئ'),
            'card_id' => Yii::t('app', 'اسم البطاقة'),
            'amount' => Yii::t('app', 'القيمة'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ChargeRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ChargeRequestQuery(get_called_class());
    }
    public  function getCard(){
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }
    public  function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public  function getCardTitle(){
        return $this->card?$this->card->title:'';
    }
}
