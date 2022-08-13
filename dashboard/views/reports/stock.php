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



    <?php  echo $this->render('_search_stock', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

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
            'card.price',
            'amount',
            'reservation_date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusText();
                },
                'filter' => \common\models\Stock::statusArray,
                'format' => 'raw',
            ],

        ],
    ]); ?>



    <div class="row">
        <div class="col-xs-6">
            <p class="lead">المجموع</p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:50%">العدد :</th>
                        <td><?= $searchModel->sum_count?></td>
                    </tr>
                    <tr>
                        <th style="width:50%">سعر التكلفة :</th>
                        <td><?= $searchModel->sum_price?></td>
                    </tr>
                    <tr>
                        <th style="width:50%">سعر البيع :</th>
                        <td><?= $searchModel->sum_amount?></td>
                    </tr>
                    <tr>
                        <th style="width:50%">الربح :</th>
                        <td><?= $searchModel->total_profit?></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
