<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\InvoicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <?= $form->field($model, 'user_id')->dropDownList(['اختر ...'] + \yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'بحث'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'تفريغ الحقول'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
