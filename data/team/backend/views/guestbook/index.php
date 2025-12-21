<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\models\GuestbookSearch */

$this->title = '评论审批';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-muted">这里只显示“待审核”的评论。</p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel, // 如果需要篩選功能，可以取消註釋此行
        'columns' => [
            'id',
            [
                'attribute' => 'content',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'max-width: 400px; white-space: normal;'],
            ],
            'name',
            'created_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{approve} {reject}',
                'buttons' => [
                    'approve' => function ($url, $model, $key) {
                        return Html::a('同意', $url, [
                            'class' => 'btn btn-xs btn-success',
                            'data-method' => 'post',
                            'data-confirm' => '您确定要批准这条评论吗？',
                        ]);
                    },
                    'reject' => function ($url, $model, $key) {
                        return Html::a('拒绝', $url, [
                            'class' => 'btn btn-xs btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => '您确定要拒绝这条评论吗？',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
