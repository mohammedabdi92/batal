<?php

namespace api\modules\v1\controllers;

use common\models\Card;
use common\models\GroupsCategory;
use common\models\MainCategory;
use common\models\SupCategory;
use yii\rest\Controller;

class SiteController extends Controller
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


    public function actionMainList(){
        $data = ['card'=>[],'request'=>[]];
        $user =  \Yii::$app->user->identity;
        $Categorys =  GroupsCategory::find()->select('main_category_id')->where(['groups_id'=>$user->group_id])->column();
        if($Categorys)
        {
            $data['card'] = MainCategory::find()->where(['status'=>1,'id'=>$Categorys,'type'=>MainCategory::TYPE_CARD])->all();
            $data['request'] = MainCategory::find()->where(['status'=>1,'id'=>$Categorys,'type'=>MainCategory::TYPE_REQUEST])->all();
        }
       return ['data'=> $data];
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