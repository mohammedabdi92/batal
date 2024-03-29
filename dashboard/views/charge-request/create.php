<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeRequest */

$this->title = Yii::t('app', 'Create Charge Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Charge Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
