<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegisterRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Register Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="register-request-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="register-request-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= $form->field($model, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Groups::find()->all(),'id','name')); ?>
            <?= Html::submitButton(Yii::t('app', 'موافقة'), ['name'=>'submit', 'value'=>'approve','class' => 'btn btn-success']) ?>
            <?= Html::submitButton(Yii::t('app', 'رفض'),[
                'name'=>'submit',
                'value'=>'reject',
                'class' => 'btn btn-danger',

            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'phone_number',
            'email',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatusText();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return \common\components\CustomFunc::getFullDate($model->created_at);
                },
                'format' => 'raw',
            ],

        ],
    ]) ?>


</div>
