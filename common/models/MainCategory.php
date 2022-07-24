<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $status
 * @property int|null $type
 * @property int|null $fields_type
 * @property string|null $image_name
 */
class MainCategory extends BaseModel
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const statusArray = [
        self::STATUS_DELETED=>"غير فعال",
        self::STATUS_ACTIVE=>"فعال",
    ];
    public  function getStatusText(){
        return self::statusArray[$this->status];
    }
    const TYPE_CARD = 1;
    const TYPE_REQUEST = 2;
    const typeArray = [
        self::TYPE_CARD=>"بطاقات",
        self::TYPE_REQUEST=>"دفع مباشر",
    ];
    public  function getTypeText(){
        return self::typeArray[$this->type];
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

    public $imageFile;

    public function fields()
    {
        return [
            'id','title',
            'image_url' => function ($model) {
                return $this->getImageUrl();
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
            [['imageFile'], 'file', 'skipOnEmpty' => !$this->isNewRecord, 'extensions' => 'png, jpg, jpeg'],
            [['status'], 'integer'],
            [['fields_type','type'],'safe'],
            [['title'], 'required'],
            [['title', 'image_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'الرقم'),
            'title' => Yii::t('app', 'الاسم'),
            'status' => Yii::t('app', 'الحالة'),
            'image_name' => Yii::t('app', 'الصورة '),
            'imageFile' => Yii::t('app', 'الصورة '),
            'fields_type' => Yii::t('app', 'نوع ادخال الطلب '),
            'type' => Yii::t('app', 'النوع '),
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


    public function upload()
    {
        if ($this->validate()) {

            if(!empty($this->imageFile))
            {
                $dir = dirname(dirname(__DIR__)) . '/api'.'/web/uploads/main-category' ;
                if(!file_exists($dir)){
                    mkdir("$dir", 0777, true);
                }
                $this->imageFile->saveAs($dir .'/'. $this->id.'-'.time() . '.' . $this->imageFile->extension);
                $this->image_name =   $this->id.'-'.time() . '.' . $this->imageFile->extension;
                $this->save(false);
            }
            return true;
        } else {
            return false;
        }
    }

    public function getImageUrl()
    {
        return $this->image_name? Yii::$app->params['api_url'].'uploads/main-category/'.$this->image_name:null;
    }


}
