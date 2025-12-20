<?php
use yii\helpers\Html;
?>

<div class="memorial-item-card">
    <div class="memorial-img">
        <?php if ($model->cover_image): ?>
            <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->name) ?>">
        <?php else: ?>
            <div class="no-img"><i class="fa fa-building"></i></div>
        <?php endif; ?>
        <div class="type-badge"><?= $model->getTypeText() ?></div>
    </div>
    <div class="memorial-content">
        <h3><?= Html::a(Html::encode($model->name), ['/memorial/view', 'id' => $model->id]) ?></h3>
        <div class="memorial-meta">
            <?php if ($model->city): ?>
            <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->city) ?></span>
            <?php endif; ?>
            <?php if ($model->established_date): ?>
            <span><i class="fa fa-calendar"></i> <?= date('Y年', strtotime($model->established_date)) ?></span>
            <?php endif; ?>
        </div>
        <?php if ($model->description): ?>
        <p><?= Html::encode(mb_substr(strip_tags($model->description), 0, 80, 'UTF-8')) ?>...</p>
        <?php endif; ?>
    </div>
</div>

<style>
.memorial-item-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.memorial-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.memorial-img {
    position: relative;
    height: 200px;
    background: #f0f0f0;
}

.memorial-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-img {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 60px;
    color: #ccc;
}

.type-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 15px;
    background: #d32f2f;
    color: #fff;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.memorial-content {
    padding: 20px;
}

.memorial-content h3 {
    font-size: 20px;
    margin: 0 0 15px 0;
}

.memorial-content h3 a {
    color: #333;
    text-decoration: none;
}

.memorial-content h3 a:hover {
    color: #d32f2f;
}

.memorial-meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.memorial-meta span {
    margin-right: 15px;
}

.memorial-meta i {
    color: #d32f2f;
    margin-right: 5px;
}

.memorial-content p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}
</style>
