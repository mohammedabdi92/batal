<?php

namespace dashboard\controllers;

use common\models\ChargeRequestSearch;
use common\models\RequestBalance;
use common\models\RequestBalanceSearch;
use common\models\StockSearch;
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

        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search($this->request->queryParams,true);

        return $this->render('stock', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionChargeRequest()
    {

        $searchModel = new ChargeRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams,true);

        return $this->render('charge-request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

 /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionRequestBalance()
    {

        $searchModel = new RequestBalanceSearch();
        $searchModel->status = RequestBalance::STATUS_PENDING;
        $dataProvider = $searchModel->search($this->request->queryParams,true);

        return $this->render('request-balance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
