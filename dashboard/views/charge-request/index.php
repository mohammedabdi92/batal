<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ChargeRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'طلبات الشحن المباشر');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<?php //= Html::a(Yii::t('app', 'Create Charge Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
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
//            [
//                'attribute' => 'field_name',
//                'value' => function($model){
//                    return $model->field_name? $model->field_name.'<div onclick="copyThis(\''.$model->field_name.'\')"> <i  class="fa fa-files-o" aria-hidden="true"></i></div> ':'';
//                },
//                'format' => 'raw',
//            ],
            'field_name',
            'field_email',
            'field_password',
            'field_id:ntext',
            'field_phone_number',
            //'created_at',
            //'updated_at',
            //'updated_by',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, \common\models\ChargeRequest $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
