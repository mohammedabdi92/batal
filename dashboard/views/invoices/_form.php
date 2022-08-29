<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Invoices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoices-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'user_id')->dropDownList([''=>'اختر .....']+\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?php
    echo $form->field($model, 'imageFile')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>$model->getImageUrl()??false,
            'initialPreviewAsData' => true,
            'showCaption' => true ,
            'showRemove' => false ,
            'showUpload' => false ,
        ]
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
