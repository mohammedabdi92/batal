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
 * @property int $count
 * @property string|null $image_name
 */
class Card extends BaseModel
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
    public $imageFile;

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
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            'id' => Yii::t('app', 'الرقم'),
            'title' => Yii::t('app', 'العنوان'),
            'price' => Yii::t('app', 'السعر'),
            'category' => Yii::t('app', 'الفئة'),
            'sup_cat_id' => Yii::t('app', 'الائحة الفرعية'),
            'status' => Yii::t('app', 'الحالة'),
            'count' => Yii::t('app', 'العدد المتوفر'),
            'image_name' => Yii::t('app', 'الصورة '),
            'imageFile' => Yii::t('app', 'الصورة '),
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

    public function upload()
    {
        if ($this->validate()) {

            if(!empty($this->imageFile))
            {
                $dir = dirname(dirname(__DIR__)) . '/api'.'/web/uploads/card' ;
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
        return $this->image_name? Yii::$app->params['api_url'].'uploads/card/'.$this->image_name:null;
    }
    public  function getSup(){
        return $this->hasOne(SupCategory::className(), ['id' => 'sup_cat_id']);
    }

    public  function getSupTitle(){
        return $this->sup?$this->sup->title:'';
    }
}
