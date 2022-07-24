<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RequestBalance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-balance-view">

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
            'amount',
            'create_at',
        ],
    ]) ?>

</div>
