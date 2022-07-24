<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class AdminLoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Admin::findByEmail($this->email);
        }

        return $this->_user;
    }
    public  static function getJwtToken($id){
        $jwt = \Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        return $jwt->getBuilder()
            ->issuedBy('http://batalapi.mohammedabadi.com')// Configures the issuer (iss claim)
            ->permittedFor('http://batalapi.mohammedabadi.com')// Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 86400)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid',$id)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token
    }
}
