<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RegisterRequest */

$this->title = Yii::t('app', 'انشاء طلب تسجيل');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Register Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
