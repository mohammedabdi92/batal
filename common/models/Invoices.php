<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $amount
 * @property string|null $note
 * @property string|null $image_name
 */
class Invoices extends BaseModel
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['user_id', 'amount'], 'integer'],
            [['user_id', 'amount'], 'required'],
            [['note', 'image_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'رقم الفاتورة'),
            'user_id' => Yii::t('app', 'المستخدم'),
            'amount' => Yii::t('app', 'قيمة الفاتورة'),
            'note' => Yii::t('app', 'ملاحظة'),
            'image_name' => Yii::t('app', 'الصورة '),
            'imageFile' => Yii::t('app', 'الصورة '),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\InvoicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\InvoicesQuery(get_called_class());
    }

    public function upload()
    {
        if ($this->validate()) {

            if(!empty($this->imageFile))
            {
                $dir = dirname(dirname(__DIR__)) . '/api'.'/web/uploads/invoices' ;
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
        return $this->image_name? Yii::$app->params['api_url'].'uploads/invoices/'.$this->image_name:null;
    }
}
