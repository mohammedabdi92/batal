<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'رجوع'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?php
        if(!$model->reservation_date)
        {
            echo Html::a(Yii::t('app', 'تعديل'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a(Yii::t('app', 'حذف'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'هل انت متاكد من حذف هذا العنصر'),
                    'method' => 'post',
                ],
            ]);
        }

        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'card_id',
                'value' => function ($model) {
                    return $model->getCardTitle();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->getUserName('user_id');
                },
                'format' => 'raw',
            ],
            'reservation_date',
            'serial_number',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusText();
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
