<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '留言管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-message-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'label'     => '用户名',
                'value'     => function ($model) {
                    return $model->member ? $model->member->username : $model->user_id;
                },
            ],
            [
                'attribute' => 'body',
                'format'    => 'ntext',
                'label'     => '留言内容',
                'contentOptions' => ['style' => 'max-width:300px; white-space:normal;'],
            ],
            [
                'attribute' => 'status',
                'label'     => '状态',
                'value'     => function ($model) {
                    return $model->status === \common\models\ContactMessage::STATUS_REPLIED ? '已回复' : '未回复';
                },
            ],
            [
                'attribute' => 'created_at',
                'format'    => ['datetime', 'php:Y-m-d H:i'],
                'label'     => '留言时间',
            ],
            [
                'attribute' => 'replied_at',
                'format'    => ['datetime', 'php:Y-m-d H:i'],
                'label'     => '回复时间',
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{reply} {delete}',
                'buttons'  => [
                    'reply' => function ($url, $model) {
                        return Html::a('回复', ['reply', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
