<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Groups */
/* @var $model_product common\models\GroupsCategory */

$this->title = Yii::t('app', 'تعديل الفئة : {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'الفئات'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'تعديل');
?>
<div class="groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_product' => $model_product,
    ]) ?>

</div>
