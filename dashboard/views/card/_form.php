<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_cat_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SupCategory::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'minimum_count')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::statusArray) ?>
    <div style=" border: 3px solid #999999; padding: 10px;">
        <?php
        $groups = \common\models\Groups::find()->all();
        foreach ($groups as $group) {
            echo $form->field($model, 'prices[' . $group->id . ']')->textInput()->label('سعر الفئة :' . $group->name);
        }
        ?>
    </div>
    <?php
    echo $form->field($model, 'imageFile')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => $model->getImageUrl() ?? false,
            'initialPreviewAsData' => true,
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
