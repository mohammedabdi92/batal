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
        $user =  \Yii::$app->user->identity;
        if($count && $card_id &&  $card = Card::find()->where(['id'=>$card_id,'status'=>1])->one())
        {

            $Stocks =  Stock::find()->where(['user_id'=>null,'card_id'=>$card_id,'status'=>1])->limit($count)->all();
            $Stocks_count = $Stocks?count($Stocks):0;
            if($Stocks && $Stocks_count== $count )
            {
                $amount  = $Stocks_count * $card->price;
                if($amount <= $user->amount)
                {
                    $user::updateAllCounters(['amount'=>-$amount],['id'=>$user->id]);
                    foreach ($Stocks as $Stock)
                    {
                        $Stock->user_id = $user->id;
                        $Stock->status = 2;
                        $Stock->reservation_date = date('Y-m-d H:i:s');
                        $Stock->save(false);

                    }
                    return ['data'=>$Stocks];
                }else{
                    return  ['error'=>'رصيدك لا يكفي'];
                }


            }else{
                return  ['error'=>'البطاقة التي طلبتها غير متوفرة'];
            }
        }
        return ['رجع ال count,card_id يا محترم'];
    }
    public function actionList(){
        $user =  \Yii::$app->user;
        return ['data'=>Stock::find()->where(['user_id'=>$user->id])->all()];
    }


}