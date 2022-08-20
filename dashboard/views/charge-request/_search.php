<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'fields_type') ?>

    <?= $form->field($model, 'field_name') ?>

    <?php // echo $form->field($model, 'field_email') ?>

    <?php // echo $form->field($model, 'field_password') ?>

    <?php // echo $form->field($model, 'field_id') ?>

    <?php // echo $form->field($model, 'field_phone_number') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'بحث'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'تفريغ الحقول'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
