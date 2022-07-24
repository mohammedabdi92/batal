<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Groups */
/* @var $model_product common\models\GroupsCategory */

$this->title = Yii::t('app', 'انشاء فئة');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_product' => $model_product,
    ]) ?>

</div>
