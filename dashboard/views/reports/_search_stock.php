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
    <?= DateRangePicker::widget([
        'model' => $model,
        'attribute' => 'reservation_date_range',
        'convertFormat' => true,
        'language'=>'en-US',
        'pluginOptions' => [
            'timePicker' => true,
            'timePickerIncrement' => 30,
            'format' => 'Y-m-d h:i A'
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
