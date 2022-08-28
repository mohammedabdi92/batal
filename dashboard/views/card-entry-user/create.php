<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CardEntryUser */

$this->title = Yii::t('app', 'Create Card Entry User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Card Entry Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-entry-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
