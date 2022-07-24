<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RequestBalance */

$this->title = Yii::t('app', 'Create Request Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
