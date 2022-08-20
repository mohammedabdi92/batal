<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model common\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['cards'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(['اختر ...'] + $model::statusArray) ?>

    <?= $form->field($model, 'user_id')->dropDownList(['اختر ...'] + \yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'card_id')->dropDownList(['اختر ...'] + \yii\helpers\ArrayHelper::map(\common\models\Card::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'reservation_date_form')->label('تاريخ الحجز')->widget(\kartik\date\DatePicker::classname(), [
        'model' => $model,
        'attribute' => 'reservation_date_from',
        'attribute2' => 'reservation_date_to',
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
        <?= Html::resetButton(Yii::t('app', 'تفريغ الحقول'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
