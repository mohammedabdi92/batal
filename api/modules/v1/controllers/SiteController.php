<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\MainCategory;
use common\models\SupCategory;
use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
//        ];
//
//        return $behaviors;
//    }
    public function actionIndex()
    {
       return "asdsadsa";
    }

    public function actionMainList(){

       return ['data'=> MainCategory::find()->where(['status'=>1])->all()];
    }
    public function actionSupList(){

        $params = \Yii::$app->request->post();
        if(!empty($params['id']))
        {
            return ['data'=> SupCategory::find()->where(['status'=>1,'main_cat_id'=>$params['id'],'sup_cat_id'=>null])->all()];
        }
        //400
        return ['رجع ال id يا محترم'];
    }
    public function actionCardList(){

        $params = \Yii::$app->request->post();
        if(!empty($params['id']))
        {
            return ['data'=> Card::find()->where(['status'=>1,'sup_cat_id'=>$params['id']])->all()];
        }
        //400
        return ['رجع ال id يا محترم'];
    }

}