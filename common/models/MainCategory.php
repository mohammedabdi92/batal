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
    public $imageFile;

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
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
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
            'id' => Yii::t('app', 'الرقم'),
            'title' => Yii::t('app', 'العنوان'),
            'status' => Yii::t('app', 'الحالة'),
            'image_name' => Yii::t('app', 'الصورة '),
            'imageFile' => Yii::t('app', 'الصورة '),
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
