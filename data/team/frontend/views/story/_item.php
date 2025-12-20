<?php
use yii\helpers\Html;
?>

<div class="story-item-card">
    <?php if ($model->cover_image): ?>
    <div class="story-img">
        <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->title) ?>">
    </div>
    <?php endif; ?>
    <div class="story-content">
        <span class="story-category label label-danger"><?= $model->getCategoryText() ?></span>
        <h3><?= Html::a(Html::encode($model->title), ['/story/view', 'id' => $model->id]) ?></h3>
        <?php if ($model->author): ?>
        <p class="story-author"><i class="fa fa-user"></i> <?= Html::encode($model->author) ?></p>
        <?php endif; ?>
        <?php if ($model->summary): ?>
        <p class="story-summary">
            <?= Html::encode(mb_substr($model->summary, 0, 100, 'UTF-8')) ?>...
        </p>
        <?php endif; ?>
        <div class="story-meta">
            <span><i class="fa fa-eye"></i> <?= $model->views ?></span>
            <span><i class="fa fa-heart"></i> <?= $model->likes ?></span>
        </div>
    </div>
</div>

<style>
.story-item-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.story-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.story-img {
    height: 200px;
    overflow: hidden;
}

.story-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.story-content {
    padding: 20px;
}

.story-category {
    margin-bottom: 10px;
}

.story-content h3 {
    font-size: 18px;
    margin: 10px 0;
}

.story-content h3 a {
    color: #333;
    text-decoration: none;
}

.story-content h3 a:hover {
    color: #d32f2f;
}

.story-author {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.story-summary {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}

.story-meta {
    font-size: 13px;
    color: #999;
    border-top: 1px solid #eee;
    padding-top: 15px;
}

.story-meta span {
    margin-right: 15px;
}
</style>
