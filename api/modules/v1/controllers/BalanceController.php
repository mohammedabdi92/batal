<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\MainCategory;
use common\models\RequestBalance;
use common\models\Stock;
use common\models\SupCategory;
use yii\rest\Controller;

class BalanceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function actionDetails(){
        $user =  \Yii::$app->user->identity;
        if($user)
        {
            return ['balance' =>$user->amount];
        }
        return null;
    }
    public function actionRequest(){
        $user =  \Yii::$app->user->identity;
        $balance = \Yii::$app->request->post('balance');
        if($user && $balance)
        {
            $req = new  RequestBalance();
            $req->user_id =$user->id;
            $req->amount = $balance;
            $req->save(false);
            return true;
        }
        return ['error'=>'يجب تعبئة المبلغ '];
    }

    public function actionList(){
        $user =  \Yii::$app->user->identity;
        if($user )
        {
            return ['data'=>RequestBalance::find()->where(['user_id'=>$user->id])->all()];
        }
        return null;
    }



}