<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Invoices */

$this->title = Yii::t('app', 'انشاء فاتورة');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
