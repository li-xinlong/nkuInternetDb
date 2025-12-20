<?php
use yii\helpers\Html;
?>

<div class="hero-item-card">
    <div class="hero-photo">
        <?php if ($model->photo): ?>
            <img src="<?= $model->photo ?>" alt="<?= Html::encode($model->name) ?>">
        <?php else: ?>
            <div class="no-photo"><i class="fa fa-user"></i></div>
        <?php endif; ?>
    </div>
    <div class="hero-info">
        <h4><?= Html::a(Html::encode($model->name), ['/hero/view', 'id' => $model->id]) ?></h4>
        <?php if ($model->rank): ?>
        <p class="hero-rank"><?= Html::encode($model->rank) ?></p>
        <?php endif; ?>
        <p class="hero-category">
            <span class="label label-danger"><?= $model->getCategoryText() ?></span>
        </p>
        <?php if ($model->death_date): ?>
        <p class="hero-date">
            牺牲于 <?= date('Y年', strtotime($model->death_date)) ?>
            <?php if ($model->getAge()): ?>
            （享年<?= $model->getAge() ?>岁）
            <?php endif; ?>
        </p>
        <?php endif; ?>
    </div>
</div>

<style>
.hero-item-card {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s;
}

.hero-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.hero-photo {
    width: 120px;
    height: 120px;
    margin: 0 auto 15px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #d32f2f;
    background: #f0f0f0;
}

.hero-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-photo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 48px;
    color: #ccc;
}

.hero-info h4 {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px 0;
}

.hero-info h4 a {
    color: #333;
    text-decoration: none;
}

.hero-info h4 a:hover {
    color: #d32f2f;
}

.hero-rank {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.hero-category {
    margin-bottom: 10px;
}

.hero-date {
    font-size: 13px;
    color: #999;
}
</style>
