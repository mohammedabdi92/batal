<?php

namespace api\modules\v1\controllers;

use common\models\RegisterRequest;
use common\models\User;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\True_;
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
                'forget-password',
                're-send-otp',
                'check-otp',
                'forget-check-otp',
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
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            $token = LoginForm::getJwtToken($model->user->id);
            return [
                'username' => (string)$model->user->username,
                'email' => (string)$model->email,
                'phone_number' => (string)$model->user->phone_number,
                'balance' => (string)$model->user->amount,
                'admin_name' => 'batal',
                'admin_email' => 'batal@gmail.com',
                'admin_phone_number' => '009627854565',
                'token' => (string)$token,
            ];
        }
        return ['errors' => (object)$model->getErrors()];

    }

    public function actionForgetPassword()
    {
        $email = \Yii::$app->request->post('email');
        if ($email) {
            $user = User::find()->where(['email' => $email, 'status' => User::STATUS_ACTIVE])->one();
            if ($user) {
                $user->reSendOtp();
                return true;
            }
        }
        return ['error' => "الايميل غير صحيح"];


    }

    public function actionForgetCheckOtp()
    {
        $email = \Yii::$app->request->post('email');
        $reg_code = \Yii::$app->request->post('otp');
        $user = User::find()->where(['email' => $email, 'status' => User::STATUS_ACTIVE])->one();
        if ($user && $reg_code) {
            if ($user->reg_code == $reg_code) {
                $token = LoginForm::getJwtToken($user->id);
                return [
                    'username' => (string)$user->username,
                    'email' => (string)$user->email,
                    'phone_number' => (string)$user->phone_number,
                    'balance' => (string)$user->amount,
                    'admin_name' => 'batal',
                    'admin_email' => 'batal@gmail.com',
                    'admin_phone_number' => '009627854565',
                    'token' => (string)$token,
                ];
            } else {
                return ['error' => 'الكود غير موجود'];
            }


        } else {
            return ['error' => 'رقم الطلب غير صحيح'];
        }

    }

    public function actionForgetChangePassword()
    {

        $password = \Yii::$app->request->post('new_password');
        $user = \Yii::$app->user->identity;
        if (!empty($password)) {
            $user->setPassword($password);
            $user->save(false);
            return ['message' => 'تم تغيير كلمة السر بنجاح'];
        } else {
            return ['error' => 'يجب ادخال كلمة السر الجديدة'];
        }


    }

    public function actionChangePassword()
    {

        $new_password = \Yii::$app->request->post('new_password');
        $password = \Yii::$app->request->post('password');
        $user = \Yii::$app->user->identity;

        if (!empty($new_password) ) {
            if( $user->validatePassword($password))
            {
                $user->setPassword($new_password);
                $user->save(false);
                return ['message' => 'تم تغيير كلمة السر بنجاح'];
            }else{
                return ['error' => 'كلمة السر غير صحيحة'];
            }
        } else {
            return ['error' => 'يجب ادخال كلمة السر الجديدة'];
        }


    }


    public function actionRegister()
    {
        $params = \Yii::$app->getRequest()->getBodyParams();
        if (!empty($params['email'])) {
            $model = RegisterRequest::find()->where(['email' => $params['email'], 'status' => RegisterRequest::STATUS_PENDING])->one();
        }
        if (!$model) {
            $model = new RegisterRequest();
        }

        if ($model->load($params, '') && $model->save()) {

            $model->reSendOtp();
            return [
                'request_id' => $model->id,
                'username' => (string)$model->username,
                'email' => (string)$model->email,
            ];
        }
        return ['errors' => (object)$model->getErrors()];
    }

    public function actionReSendOtp()
    {
        $request_id = \Yii::$app->request->post('request_id');
        if ($request_id) {
            $request = RegisterRequest::find()->where(['id' => $request_id])->one();
            if ($request) {
                $request->reSendOtp();
                return true;
            }

        }
        return ['error' => 'رقم الطلب غير صحيح'];


    }

    public function actionCheckOtp()
    {
        $request_id = \Yii::$app->request->post('request_id');
        $reg_code = \Yii::$app->request->post('otp');

        if ($request_id && $reg_code) {
            $request = RegisterRequest::find()->where(['id' => $request_id, 'status' => RegisterRequest::STATUS_PENDING])->one();
            if ($request) {
                if ($request->reg_code == $reg_code) {
                    $request->status = RegisterRequest::STATUS_ACTIVE;
                    $request->save(false);
                    return ['message' => "تم تسجيل طلبك بنجاح سيتم التواصل معك قريبا"];
                } else {
                    return ['error' => 'الكود غير موجود'];
                }

            } else {
                return ['error' => 'الطلب غير موجود'];
            }
        } else {
            return ['error' => 'رقم الطلب غير صحيح'];
        }

    }
}