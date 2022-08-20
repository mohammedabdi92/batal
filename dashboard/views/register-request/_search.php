<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RegisterRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="register-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'reg_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'بحث'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'تفريغ الحقول'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
