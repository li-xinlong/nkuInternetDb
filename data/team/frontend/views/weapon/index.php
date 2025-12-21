<?php
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = '武器装备';
?>

<div class="container">
    <div class="page-header-custom">
        <h1><i class="fa fa-shield"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">抗战时期的武器装备</p>
    </div>

    <div class="weapon-list">
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

.weapon-list {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
</style>
