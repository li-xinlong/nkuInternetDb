<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '战役管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('发布战役信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'location',
            'start_date',
            'end_date',
            [
                'attribute' => 'result',
                'value' => function ($model) {
                    return $model->getResultText();
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status ? '<span class="label label-success">显示</span>' : '<span class="label label-danger">隐藏</span>';
                },
            ],
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

