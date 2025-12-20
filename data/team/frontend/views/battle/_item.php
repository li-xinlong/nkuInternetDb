<?php
use yii\helpers\Html;
?>

<div class="battle-item-card">
    <div class="battle-img">
        <?php if ($model->cover_image): ?>
            <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->name) ?>">
        <?php else: ?>
            <div class="no-img"><i class="fa fa-image"></i></div>
        <?php endif; ?>
        <div class="result-badge badge-<?= $model->result ?>">
            <?= $model->getResultText() ?>
        </div>
    </div>
    <div class="battle-content">
        <h3><?= Html::a(Html::encode($model->name), ['/battle/view', 'id' => $model->id]) ?></h3>
        <div class="battle-meta">
            <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->location) ?></span>
            <span><i class="fa fa-calendar"></i> <?= date('Y-m-d', strtotime($model->start_date)) ?></span>
        </div>
        <?php if ($model->description): ?>
        <p><?= Html::encode(mb_substr(strip_tags($model->description), 0, 80, 'UTF-8')) ?>...</p>
        <?php endif; ?>
    </div>
</div>

<style>
.battle-item-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.battle-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.battle-img {
    position: relative;
    height: 200px;
    background: #f0f0f0;
}

.battle-img img {
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

.result-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 15px;
    border-radius: 20px;
    color: #fff;
    font-weight: bold;
    font-size: 12px;
}

.badge-victory { background: #4caf50; }
.badge-defeat { background: #f44336; }
.badge-stalemate { background: #ff9800; }

.battle-content {
    padding: 20px;
}

.battle-content h3 {
    font-size: 20px;
    margin: 0 0 15px 0;
}

.battle-content h3 a {
    color: #333;
    text-decoration: none;
}

.battle-content h3 a:hover {
    color: #d32f2f;
}

.battle-meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.battle-meta span {
    margin-right: 15px;
}

.battle-meta i {
    color: #d32f2f;
    margin-right: 5px;
}

.battle-content p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}
</style>
