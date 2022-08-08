<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\CardPrices;
use common\models\ChargeRequest;
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

    public function actionCharge()
    {
        $count = \Yii::$app->request->post('count');
        $card_id = \Yii::$app->request->post('card_id');
        $user = \Yii::$app->user->identity;
        if ($count && $card_id && $card = Card::find()->where(['id' => $card_id, 'status' => 1])->one()) {

            $Stocks = Stock::find()->where(['user_id' => null, 'card_id' => $card_id, 'status' => 1])->limit($count)->all();
            $Stocks_count = $Stocks ? count($Stocks) : 0;
            if ($Stocks && $Stocks_count == $count) {
                $priceModel = CardPrices::find()->where(['card_id' => $card->id, 'groups_id' => $user->group_id])->one();
                if ($priceModel) {
                    $amount = $Stocks_count * $priceModel->price;

                    if ($amount <= $user->amount) {
                        $user::updateAllCounters(['amount' => -$amount], ['id' => $user->id]);
                        foreach ($Stocks as $Stock) {
                            $Stock->user_id = $user->id;
                            $Stock->amount = $amount;
                            $Stock->status = 2;
                            $Stock->reservation_date = date('Y-m-d H:i:s');
                            $Stock->save(false);
                            $card->updateCounters(['count' => -1]);

                        }
                        return ['data' => $Stocks];
                    } else {
                        return ['error' => 'رصيدك لا يكفي'];
                    }
                } else {

                    return ['error' => 'البطاقة لا تحتوي على سعر يرجا التواصل مع مدير الموقع'];
                }

            } else {
                return ['error' => 'البطاقة التي طلبتها غير متوفرة'];
            }
        }
        return ['رجع ال count,card_id يا محترم'];
    }

    public function actionChargeRequest()
    {
        $card_id = \Yii::$app->request->post('card_id');
        $fields_type = \Yii::$app->request->post('fields_type');
        $user = \Yii::$app->user->identity;
        if ($card_id && $fields_type) {
            if ($card = Card::find()->where(['id' => $card_id, 'status' => 1])->one()) {
                $priceModel = CardPrices::find()->where(['card_id' => $card->id, 'groups_id' => $user->group_id])->one();
                if ($priceModel) {
                    $amount = $priceModel->price;
                    if ($amount <= $user->amount) {
                        $request = new ChargeRequest();
                        $request->load(\Yii::$app->request->post(), '');
                        if ($request->validate()) {
                            $request->user_id = $user->id;
                            $request->amount = $amount;
                            $request->save();
                            $user::updateAllCounters(['amount' => -$amount], ['id' => $user->id]);
                        }
                        return ['message'=> 'تم ارسال الطلب بنجاح'];
                    } else {
                        return ['error' => 'رصيدك لا يكفي'];
                    }
                } else {

                    return ['error' => 'البطاقة لا تحتوي على سعر يرجا التواصل مع مدير الموقع'];
                }


            } else {
                return ['error' => 'رقم البطاقة غير صحيح'];
            }
        }
        return ['error'=>'يجب ارسال card_id ,fields_type '];
    }

    public function actionList()
    {
        $user = \Yii::$app->user;
        return ['data' => Stock::find()->where(['user_id' => $user->id])->orderby('id desc')->all()];
    }


}