<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '故事审批';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'author',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 0) {
                        return '<span class="label label-warning">待审核</span>';
                    } elseif ($model->status == 1) {
                        return '<span class="label label-success">已批准</span>';
                    } else {
                        return '<span class="label label-danger">已拒绝</span>';
                    }
                },
            ],
            'created_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {approve} {reject} {delete}',
                'buttons' => [
                    'approve' => function ($url, $model, $key) {
                        if ($model->status == 0) {
                            return Html::a('批准', $url, ['class' => 'btn btn-xs btn-success', 'data-method' => 'post']);
                        }
                        return '';
                    },
                    'reject' => function ($url, $model, $key) {
                        if ($model->status == 0) {
                            return Html::a('拒绝', $url, ['class' => 'btn btn-xs btn-warning', 'data-method' => 'post']);
                        }
                        return '';
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

