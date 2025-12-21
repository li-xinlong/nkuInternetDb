<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Story */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '故事审批', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="story-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->status != 1): ?>
            <?= Html::a('批准', ['approve', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?php if ($model->status != 2): ?>
            <?= Html::a('拒绝', ['reject', 'id' => $model->id], ['class' => 'btn btn-warning', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除这个故事吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'author',
            'category',

            'summary:ntext',
            'content:ntext',
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
            'updated_at:datetime',
        ],
    ]) ?>

</div>

