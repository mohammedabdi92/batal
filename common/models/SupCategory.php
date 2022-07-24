<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sup_category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $main_cat_id
 * @property int|null $sup_cat_id
 * @property int|null $status
 * @property string|null $image_name
 */
class SupCategory extends \common\models\BaseModel
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
        return 'sup_category';
    }

    public function fields()
    {
        return [
            'id','title',
            'image_url' => function ($model) {
                return $this->getImageUrl();
            },
            'children'=>function($model){
                return  self::find()->where(['sup_cat_id'=>$this->id])->all() ;
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => !$this->isNewRecord, 'extensions' => 'png, jpg, jpeg'],
            [['main_cat_id', 'status'], 'integer'],
            [['sup_cat_id'], 'singleParent'],
            [['title'], 'required'],
            [['title', 'image_name'], 'string', 'max' => 255],
        ];
    }
    public function singleParent(){
        if(!empty($this->parent) && ($this->parent->id == $this->id)   )
        {
            $this->addError('sup_cat_id','لا يمكنك ربط القائمة الفرعية بنفسها ');
        }
        if(!empty($this->parent) && !empty($this->parent->parent))
        {
            $this->addError('sup_cat_id','القائمة الفرعية مربوطة بلائحة اخرى');
        }

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'الرقم'),
            'title' => Yii::t('app', 'الاسم'),
            'main_cat_id' => Yii::t('app', 'الائحة'),
            'status' => Yii::t('app', 'الحالة'),
            'image_name' => Yii::t('app', 'الصورة '),
            'sup_cat_id' => Yii::t('app', 'القائمة الفرعية  '),
            'imageFile' => Yii::t('app', 'الصورة '),
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

    public function upload()
    {
        if ($this->validate()) {

            if(!empty($this->imageFile))
            {
                $dir = dirname(dirname(__DIR__)) . '/api'.'/web/uploads/sup-category' ;

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
        return $this->image_name? Yii::$app->params['api_url'].'uploads/sup-category/'.$this->image_name:null;
    }
    public  function getMain(){
        return $this->hasOne(MainCategory::className(), ['id' => 'main_cat_id']);
    }
    public  function getParent(){
        return $this->hasOne(self::className(), ['id' => 'sup_cat_id']);
    }

    public  function getMainTitle(){
        return $this->main?$this->main->title:'';
    }
}
