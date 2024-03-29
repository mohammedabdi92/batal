<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\SupCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sup-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_cat_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MainCategory::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'sup_cat_id')->dropDownList([null=>'اختر القائمة الفرعية ...']+\yii\helpers\ArrayHelper::map(\common\models\SupCategory::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'status')->dropDownList($model::statusArray) ?>



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
