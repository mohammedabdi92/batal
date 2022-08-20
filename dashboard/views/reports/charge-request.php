<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ChargeRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ' تقرير طلبات الشحن المباشر');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-request-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php  echo $this->render('_search_charge_req', ['model' => $searchModel]); ?>

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
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatusText();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'fields_type',
                'value' => function($model){
                    return $model->fieldsTypeText();
                },
                'format' => 'raw',
            ],
            'amount',

            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return \common\components\CustomFunc::getFullDate($model->created_at);
                },
                'format' => 'raw',
            ],


        ],
    ]); ?>


</div>
