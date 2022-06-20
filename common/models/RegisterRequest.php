<?php
namespace common\models;

use common\components\CustomFunc;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $phone_number
 * @property string $reg_code
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class RegisterRequest extends ActiveRecord
{
    public $password;
    const STATUS_DELETED = 0;
    const STATUS_PENDING = 3;
    const STATUS_ACTIVE = 5;
    const STATUS_APPROVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%register_request}}';
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
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['username','email'], 'required'],
            [['email' ], 'unique'],
            [['email' ], 'validEmail'],
            [['phone_number'],'safe'],
            [['password'], 'required','on'=>"create"],
            ['status', 'default', 'value' => self::STATUS_PENDING],
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            $this->setPassword();
            $this->generateCode();
            $this->sendOtp();

        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


    public function validEmail($attr, $params){
        $user = User::findByEmail($this->email);
        if($user)
        {
            $this->addError($attr, Yii::t('app', 'البريد الالكتروني "'.$this->email.'" موجود بالفعل'));
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword()
    {
        return Yii::$app->security->validatePassword($this->password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

    public function generateCode()
    {
       return $this->reg_code = CustomFunc::getRandomString(4, true);//'9512';
    }
    public function reSendOtp()
    {
        $this->generateCode();
        $this->save(false);
        return $this->sendOtp();
    }

    public function sendOtp(){
        return Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom(["info@mohammedabadi.com"])
            ->setSubject('تاكيد طلب التسجيل')
            ->setTextBody($this->reg_code)
            ->send();
    }
}
