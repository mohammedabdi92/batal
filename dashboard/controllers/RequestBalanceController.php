<?php

namespace dashboard\controllers;

use common\models\RequestBalance;
use common\models\RequestBalanceSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestBalanceController implements the CRUD actions for RequestBalance model.
 */
class RequestBalanceController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all RequestBalance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestBalanceSearch();
        $searchModel->status = RequestBalance::STATUS_PENDING;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestBalance model.
     * @param int $id الرقم
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ($this->request->isPost) {
            $req =  RequestBalance::find()->where(['id' => $id])->one();
            $submit = \Yii::$app->request->post('submit');
            $user  = User::findOne($req->user_id);
            if($req && $user)
            {
                if($submit == "reject")
                {
                    $req->status = RequestBalance::STATUS_REJECTED;
                    $req->save(false);
                    $this->redirect(['index']);
                }
                if($submit == "approve")
                {
                    $req->status = RequestBalance::STATUS_APPROVED;
                    $user->amount += $req->amount;
                    $user->save(false);
                    $req->save(false);
                    $this->redirect(['user/index']);

                }
            }


        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RequestBalance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RequestBalance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequestBalance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id الرقم
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RequestBalance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id الرقم
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RequestBalance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id الرقم
     * @return RequestBalance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestBalance::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
