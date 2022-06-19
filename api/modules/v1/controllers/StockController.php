<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\MainCategory;
use common\models\Stock;
use common\models\SupCategory;
use yii\rest\Controller;

class StockController extends Controller
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

    public function actionCharge(){
        $count = \Yii::$app->request->post('count');
        $card_id = \Yii::$app->request->post('card_id');
        if($count && $card_id )
        {
            $Stocks =  Stock::find()->where(['user_id'=>null,'card_id'=>$card_id])->limit($count)->all();
            if($Stocks && count($Stocks) == $count )
            {
                return ['data'=>$Stocks];

            }else{
                return  ['error'=>'البطاقة التي طلبتها غير متوفرة'];
            }
        }
        return ['رجع ال count,card_id يا محترم'];
    }
    public function actionList(){



        //400
        return ['رجع ال id يا محترم'];
    }


}