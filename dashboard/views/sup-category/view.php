<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SupCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'القائمة الفرعية'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sup-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'رجوع'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'تعديل'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'حذف'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'هل انت متاكد من حذف هذا العنصر'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatusText();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'main_cat_id',
                'value' => function($model){
                    return $model->getMainTitle();
                },
                'format' => 'raw',
            ],
            [
                'attribute'=>'image_name',
                'value'=>$model->imageUrl,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],

        ],
    ]) ?>

</div>
