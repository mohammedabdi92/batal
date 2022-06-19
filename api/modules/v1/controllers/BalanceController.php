<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\MainCategory;
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
  


}