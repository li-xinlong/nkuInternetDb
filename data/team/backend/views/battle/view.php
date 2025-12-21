<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Battle */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '战役管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="battle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'english_name',
            'location',
            'latitude',
            'longitude',
            'start_date',
            'end_date',
            'duration_days',
            'commander_cn',
            'commander_jp',
            'troops_cn',
            'troops_jp',
            'casualties_cn',
            'casualties_jp',
            [
                'attribute' => 'result',
                'value' => $model->getResultText(),
            ],
            'significance:ntext',
            'description:ntext',
            'importance_level',
            'views',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->status ? '<span class="label label-success">顯示</span>' : '<span class="label label-danger">隱藏</span>',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>

