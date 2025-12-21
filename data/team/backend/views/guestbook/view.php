<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Guestbook */

$this->title = '查看评论 #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '评论审批', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guestbook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->status != 1): ?>
            <?= Html::a('批准', ['approve', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?php if ($model->status != 2): ?>
            <?= Html::a('拒絕', ['reject', 'id' => $model->id], ['class' => 'btn btn-warning', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('刪除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此项目吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'content:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 0) {
                        return '<span class="label label-warning">待審核</span>';
                    } elseif ($model->status == 1) {
                        return '<span class="label label-success">已批准</span>';
                    } else {
                        return '<span class="label label-danger">已拒絕</span>';
                    }
                },
            ],
            'ip',
            'created_at:datetime',
            [
                'attribute' => 'related_model',
                'label' => '關聯',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->related_model && $model->related_id) {
                        $url = Yii::$app->params['frontendHostInfo'] . '/' . $model->related_model . '/view?id=' . $model->related_id;
                        return Html::a($model->related_model . ' #' . $model->related_id, $url, ['target' => '_blank']);
                    }
                    return 'N/A';
                }
            ],
        ],
    ]) ?>

</div>

