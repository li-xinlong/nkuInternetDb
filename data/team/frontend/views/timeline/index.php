<?php
use yii\helpers\Html;

$this->title = '历史时间轴';
?>

<div class="container">
    <div class="page-header-custom">
        <h1><i class="fa fa-clock-o"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">14年抗战的艰苦历程</p>
    </div>

    <div class="timeline-container">
        <?php foreach ($events as $index => $event): ?>
        <div class="timeline-item <?= $index % 2 == 0 ? 'left' : 'right' ?>">
            <div class="timeline-marker"></div>
            <div class="timeline-content">
                <div class="timeline-date">
                    <?= date('Y年m月d日', strtotime($event->event_date)) ?>
                </div>
                <h3><?= Html::encode($event->title) ?></h3>
                <span class="timeline-category label label-danger"><?= $event->getCategoryText() ?></span>
                <?php if ($event->location): ?>
                <p class="timeline-location">
                    <i class="fa fa-map-marker"></i> <?= Html::encode($event->location) ?>
                </p>
                <?php endif; ?>
                <?php if ($event->description): ?>
                <p class="timeline-desc">
                    <?= Html::encode(mb_substr($event->description, 0, 150, 'UTF-8')) ?>...
                </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.page-header-custom {
    text-align: center;
    padding: 40px 0;
    border-bottom: 3px solid #d32f2f;
    margin-bottom: 60px;
}

.page-header-custom h1 {
    font-size: 48px;
    color: #d32f2f;
    margin-bottom: 10px;
}

.timeline-container {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 0;
}

.timeline-container::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #d32f2f;
    transform: translateX(-50%);
}

.timeline-item {
    position: relative;
    width: 45%;
    margin-bottom: 50px;
}

.timeline-item.left {
    left: 0;
    text-align: right;
}

.timeline-item.right {
    left: 55%;
}

.timeline-marker {
    position: absolute;
    width: 20px;
    height: 20px;
    background: #d32f2f;
    border: 4px solid #fff;
    border-radius: 50%;
    top: 0;
    box-shadow: 0 0 0 4px #d32f2f;
}

.timeline-item.left .timeline-marker {
    right: -60px;
}

.timeline-item.right .timeline-marker {
    left: -60px;
}

.timeline-content {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-date {
    display: inline-block;
    padding: 8px 20px;
    background: #d32f2f;
    color: #fff;
    border-radius: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.timeline-content h3 {
    font-size: 20px;
    font-weight: bold;
    margin: 0 0 10px 0;
    color: #333;
}

.timeline-category {
    margin-bottom: 10px;
}

.timeline-location {
    font-size: 14px;
    color: #666;
    margin: 10px 0;
}

.timeline-desc {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-top: 10px;
}
</style>
