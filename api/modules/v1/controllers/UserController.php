<?php

namespace api\modules\v1\controllers;

use common\models\RegisterRequest;
use Yii;
use common\models\LoginForm;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\rest\Controller;

class UserController extends Controller
{



    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
                'register',
            ],
        ];

        return $behaviors;
    }
    /**
     * @SWG\Post(path="/v1/user/login",

     *     tags={"user"},
     *     summary="Login",

     *      @SWG\Parameter(
     *          ref="#/parameters/username"
     *     ),
     *      @SWG\Parameter(
     *          ref="#/parameters/password"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "user information",
     *     ),
     *   security={{
     *     "token":{}
     *   }}
     * )
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') &&  $model->login()) {
            $jwt = \Yii::$app->jwt;
            $signer = $jwt->getSigner('HS256');
            $key = $jwt->getKey();
            $time = time();
            $token = $jwt->getBuilder()
                ->issuedBy('http://batalapi.mohammedabadi.com')// Configures the issuer (iss claim)
                ->permittedFor('http://batalapi.mohammedabadi.com')// Configures the audience (aud claim)
                ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                ->issuedAt($time)// Configures the time that the token was issue (iat claim)
                ->expiresAt($time + 86400)// Configures the expiration time of the token (exp claim)
                ->withClaim('uid', $model->user->id)// Configures a new claim, called "uid"
                ->getToken($signer, $key); // Retrieves the generated token

            return [
                'username' => (string)$model->user->username,
                'email' => (string)$model->email,
                'phone_number' => (string)$model->user->phone_number,
                'amount' => (string)$model->user->amount,
                'token' => (string)$token,
            ];
        }
        return [ 'errors' => (object)$model->getErrors()];

    }


    public function actionRegister()
    {
        $params = \Yii::$app->getRequest()->getBodyParams();
        if(!empty($params['email']))
        {
            $model=  RegisterRequest::find()->where(['email'=>$params['email'],])->one();
        }
        $model = new RegisterRequest();
        if ($model->load($params, '') && $model->save()) {
            return [
                'username' => (string)$model->username,
                'email' => (string)$model->email,
                'code' => (string)$model->reg_code,
            ];
        }
        return [ 'errors' => (object)$model->getErrors()];
    }
}