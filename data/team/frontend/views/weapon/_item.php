<?php
use yii\helpers\Html;
?>

<div class="weapon-item-card">
    <div class="weapon-img">
        <?php if ($model->image): ?>
            <img src="<?= $model->image ?>" alt="<?= Html::encode($model->name) ?>">
        <?php else: ?>
            <div class="no-img"><i class="fa fa-shield"></i></div>
        <?php endif; ?>
    </div>
    <div class="weapon-content">
        <h3><?= Html::a(Html::encode($model->name), ['/weapon/view', 'id' => $model->id]) ?></h3>
        <?php if ($model->model): ?>
        <p class="weapon-model">型号：<?= Html::encode($model->model) ?></p>
        <?php endif; ?>
        <div class="weapon-meta">
            <span class="label label-primary"><?= $model->getCategoryText() ?></span>
            <?php if ($model->country): ?>
            <span class="label label-default"><?= Html::encode($model->country) ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.weapon-item-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.weapon-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.weapon-img {
    height: 200px;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.weapon-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.no-img {
    font-size: 60px;
    color: #ccc;
}

.weapon-content {
    padding: 20px;
}

.weapon-content h3 {
    font-size: 20px;
    margin: 0 0 10px 0;
}

.weapon-content h3 a {
    color: #333;
    text-decoration: none;
}

.weapon-content h3 a:hover {
    color: #d32f2f;
}

.weapon-model {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.weapon-meta .label {
    margin-right: 5px;
}
</style>
