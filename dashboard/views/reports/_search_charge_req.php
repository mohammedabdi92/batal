<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['charge-request'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'user_id')->dropDownList([''=>'اختر .....']+\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'status')->dropDownList([''=>'اختر .....']+$model::statusArray) ?>


    <?= $form->field($model, 'created_at_from')->label('تاريخ ')->widget(\kartik\date\DatePicker::classname(), [
        'model' => $model,
        'attribute' => 'created_at_from',
        'attribute2' => 'created_at_to',
        'options' => ['placeholder' => 'Created Date From'],
        'options2' => ['placeholder' => 'Created Date To'],
        'type' => \kartik\date\DatePicker::TYPE_RANGE,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'بحث'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'تفريغ الحقول'), ['charge-request'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
