<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'البطاقات');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'اضافة بطاقة'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'card_id',
                'value' => function ($model) {
                    return $model->getCardTitle();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->getUserName('user_id');
                },
                'format' => 'raw',
            ],
            'reservation_date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusText();
                },
                'filter' => \common\models\Stock::statusArray,
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'delete' => function ($url, $model) {

                        if (!$model->reservation_date) {
                            return Html::a('<span class="fa fa-trash"></span>', $url);
                        }

                    },
                    'update' => function ($url, $model) {
                        if (!$model->reservation_date) {
                            return Html::a('<span class="fa fa-pencil"></span>', $url);
                        }

                    },

                ],
                'urlCreator' => function ($action, \common\models\Stock $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
