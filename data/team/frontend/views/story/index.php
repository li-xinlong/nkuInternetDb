<?php
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = '抗战故事';
?>

<div class="container">
    <div class="page-header-custom">
        <h1><i class="fa fa-book"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">真实的记忆，感人的瞬间</p>
    </div>

    <div class="story-list">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'layout' => '<div class="row">{items}</div><div class="text-center">{pager}</div>',
            'itemOptions' => ['class' => 'col-md-4 col-sm-6'],
        ]); ?>
    </div>
</div>

<style>
.page-header-custom {
    text-align: center;
    padding: 40px 0;
    border-bottom: 3px solid #d32f2f;
    margin-bottom: 40px;
}

.page-header-custom h1 {
    font-size: 48px;
    color: #d32f2f;
    margin-bottom: 10px;
}

.story-list {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
</style>
