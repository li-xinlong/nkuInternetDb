<?php
use yii\helpers\Html;

$this->title = $model->title;
?>

<div class="container">
    <div class="story-detail">
        <h1><?= Html::encode($model->title) ?></h1>
        
        <div class="story-meta-header">
            <span class="label label-danger"><?= $model->getCategoryText() ?></span>
            <?php if ($model->author): ?>
            <span><i class="fa fa-user"></i> <?= Html::encode($model->author) ?></span>
            <?php endif; ?>
            <?php if ($model->event_date): ?>
            <span><i class="fa fa-calendar"></i> <?= date('Y年m月d日', strtotime($model->event_date)) ?></span>
            <?php endif; ?>
            <span><i class="fa fa-eye"></i> <?= $model->views ?></span>
        </div>

        <?php if ($model->cover_image): ?>
        <div class="story-cover">
            <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->title) ?>" class="img-responsive">
        </div>
        <?php endif; ?>

        <?php if ($model->summary): ?>
        <div class="story-summary">
            <strong>摘要：</strong><?= Html::encode($model->summary) ?>
        </div>
        <?php endif; ?>

        <div class="story-content">
            <?= nl2br(Html::encode($model->content)) ?>
        </div>

        <div class="back-btn">
            <?= Html::a('<i class="fa fa-arrow-left"></i> 返回故事列表', ['/story/index'], ['class' => 'btn btn-lg btn-danger']) ?>
        </div>
    </div>
</div>

<style>
.story-detail {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px 0;
}

.story-detail h1 {
    font-size: 36px;
    font-weight: bold;
    color: #d32f2f;
    margin-bottom: 20px;
    text-align: center;
}

.story-meta-header {
    text-align: center;
    padding-bottom: 20px;
    margin-bottom: 30px;
    border-bottom: 2px solid #eee;
    font-size: 14px;
    color: #666;
}

.story-meta-header span {
    margin: 0 15px;
}

.story-cover {
    text-align: center;
    margin-bottom: 30px;
}

.story-cover img {
    border-radius: 8px;
    max-width: 100%;
}

.story-summary {
    background: #f9f9f9;
    padding: 20px;
    border-left: 4px solid #d32f2f;
    margin-bottom: 30px;
    font-size: 16px;
    line-height: 1.8;
}

.story-content {
    font-size: 16px;
    line-height: 2;
    color: #333;
    text-align: justify;
}

.back-btn {
    text-align: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}
</style>
