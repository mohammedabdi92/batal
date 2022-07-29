<?php

namespace dashboard\controllers;

use common\models\ChargeRequest;
use common\models\ChargeRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChargeRequestController implements the CRUD actions for ChargeRequest model.
 */
class ChargeRequestController extends Controller
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
     * Lists all ChargeRequest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ChargeRequestSearch();
        $searchModel->status = ChargeRequest::STATUS_PENDING;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChargeRequest model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ($this->request->isPost) {
            $req =  ChargeRequest::find()->where(['id' => $id,'status'=>ChargeRequest::STATUS_PENDING])->one();
            $submit = \Yii::$app->request->post('submit');
            $RegisterRequest =\Yii::$app->request->post('RegisterRequest');

            if($req)
            {
                if($submit == "reject")
                {
                    $user = $req->user;
                    if($user)
                    {
                        $user::updateAllCounters(['amount' => $req->amount], ['id' => $user->id]);
                    }
                    $req->status = ChargeRequest::STATUS_REJECTED;

                    $req->save(false);
                    $this->redirect(['index']);
                }
                if($submit == "approve")
                {
                    $req->status = ChargeRequest::STATUS_APPROVED;
                    $req->save(false);
                    $this->redirect(['index']);

                }
            }


        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChargeRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ChargeRequest();

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
     * Updates an existing ChargeRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
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
     * Deletes an existing ChargeRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChargeRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ChargeRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChargeRequest::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
