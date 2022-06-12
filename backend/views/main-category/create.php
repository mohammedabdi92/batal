<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MainCategory */

$this->title = Yii::t('app', 'Create Main Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
