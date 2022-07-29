<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'fields_type')->textInput() ?>

    <?= $form->field($model, 'field_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'field_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'field_password')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'field_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'field_phone_number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
