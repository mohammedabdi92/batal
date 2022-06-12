<?php

namespace api\modules\v1\controllers;

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
    public function actionIndex()
    {
       return "asdsadsa";
    }

}