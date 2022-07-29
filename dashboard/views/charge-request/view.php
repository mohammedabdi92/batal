<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'طلبات الشحن المباشر'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="charge-request-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <p>
        <?= Html::submitButton(Yii::t('app', 'موافقة'), ['name'=>'submit', 'value'=>'approve','class' => 'btn btn-success']) ?>
        <?= Html::submitButton(Yii::t('app', 'رفض'),[
            'name'=>'submit',
            'value'=>'reject',
            'class' => 'btn btn-danger',

        ]) ?>
    </p>
    <?php ActiveForm::end(); ?>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'field_name:ntext',
            'field_email:ntext',
            'field_password:ntext',
            'field_id:ntext',
            'field_phone_number:ntext',
//            'created_at',
//            'updated_at',
//            'updated_by',
//            'created_by',
        ],
    ]) ?>

</div>
