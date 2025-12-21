<?php
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = '抗战故事';
?>

<div class="container">
    <div class="page-header-custom">
        <h1><i class="fa fa-book"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">真实的记忆，感人的瞬间</p>
        <?php if (!Yii::$app->user->isGuest): ?>
            <p>
                <?= Html::a('分享您的抗战故事', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
            </p>
        <?php endif; ?>
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

.story-list .row {
    display: flex;
    flex-wrap: wrap;
}

.story-list .col-md-4 {
    display: flex;
    flex-direction: column;
}

.story-item-card {
    flex: 1; /* 让卡片在 flex 容器中均匀填充可用空间 */
    display: flex;
    flex-direction: column;
}

.story-content {
    flex: 1; /* 让内容区域填充卡片剩余空间 */
    display: flex;
    flex-direction: column;
}

.story-summary {
    flex-grow: 1; /* 让摘要部分占据最多的可用空间 */
}
</style>
