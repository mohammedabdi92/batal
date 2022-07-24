<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SupCategory */

$this->title = Yii::t('app', 'انشاء قائمة فرعية');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'القائمة الفرعية'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sup-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
