<?php

namespace dashboard\controllers;

use common\models\User;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class ReportsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [

                    ],
                ],
            ]
        );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $counts['active_users'] = User::find()->where(['status'=>User::STATUS_ACTIVE])->count();

        return $this->render('index',
        ['counts'=>$counts]
        );
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCards()
    {
        $counts['active_users'] = User::find()->where(['status'=>User::STATUS_ACTIVE])->count();

        return $this->render('cards',
            ['counts'=>$counts]
        );
    }


}
