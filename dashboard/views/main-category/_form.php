<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MainCategory */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    // $(document).on('change', '#maincategory-type', function (item) {
    //     debugger;
    // });
</script>
<div class="main-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\MainCategory::typeArray) ?>

    <?= $form->field($model, 'fields_type',['options'=>['style'=>($model->type == $model::TYPE_CARD)?'display:block':'display:block']])->dropDownList([''=>'اختار ...']+\common\models\MainCategory::fieldsTypeArray ) ?>

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
