<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '首页';
?>

<!-- 英雄横幅 -->
<div class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <h1 class="hero-title">铭记历史 缅怀先烈</h1>
            <p class="hero-subtitle">纪念中国人民抗日战争暨世界反法西斯战争胜利80周年</p>
            <div class="hero-date">1945 - 2025</div>
            <div class="hero-buttons">
                <?= Html::a('<i class="fa fa-book"></i> 了解历史', ['/timeline/index'], ['class' => 'btn btn-lg btn-danger']) ?>
                <?= Html::a('<i class="fa fa-users"></i> 缅怀英烈', ['/hero/index'], ['class' => 'btn btn-lg btn-outline']) ?>
            </div>
        </div>
    </div>
</div>

<!-- 统计数据 -->
<div class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="stat-box">
                    <div class="stat-icon"><i class="fa fa-crosshairs"></i></div>
                    <div class="stat-number"><?= $stats['battles'] ?></div>
                    <div class="stat-label">重要战役</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-box">
                    <div class="stat-icon"><i class="fa fa-user"></i></div>
                    <div class="stat-number"><?= $stats['heroes'] ?></div>
                    <div class="stat-label">英雄人物</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-box">
                    <div class="stat-icon"><i class="fa fa-building"></i></div>
                    <div class="stat-number"><?= $stats['memorials'] ?></div>
                    <div class="stat-label">纪念场馆</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 重点战役 -->
<div class="section featured-battles">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">重点战役</h2>
            <p class="section-subtitle">血与火的洗礼，民族精神的丰碑</p>
            <?= Html::a('查看更多 <i class="fa fa-arrow-right"></i>', ['/battle/index'], ['class' => 'section-more']) ?>
        </div>
        
        <div class="row">
            <?php foreach ($featuredBattles as $battle): ?>
            <div class="col-md-4 col-sm-6">
                <div class="battle-card">
                    <div class="battle-info">
                        <div class="battle-header">
                            <h3><?= Html::a(Html::encode($battle->name), ['/battle/view', 'id' => $battle->id]) ?></h3>
                            <span class="battle-result result-<?= $battle->result ?>">
                                <?= $battle->getResultText() ?>
                            </span>
                        </div>
                        <div class="battle-meta">
                            <span><i class="fa fa-map-marker"></i> <?= Html::encode($battle->location) ?></span>
                            <span><i class="fa fa-calendar"></i> <?= date('Y年m月', strtotime($battle->start_date)) ?></span>
                        </div>
                        <p class="battle-desc">
                            <?= Html::encode(mb_substr(strip_tags($battle->description), 0, 80, 'UTF-8')) ?>...
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 英雄人物 -->
<div class="section heroes-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">英雄人物</h2>
            <p class="section-subtitle">他们用生命捍卫民族尊严</p>
            <?= Html::a('查看更多 <i class="fa fa-arrow-right"></i>', ['/hero/index'], ['class' => 'section-more']) ?>
        </div>
        
        <div class="row">
            <?php foreach ($heroes as $hero): ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="hero-card">
                    <?= Html::a('', ['/hero/view', 'id' => $hero->id], ['class' => 'hero-link']) ?>
                    <div class="hero-photo">
                        <?php if ($hero->photo): ?>
                            <img src="<?= $hero->photo ?>" alt="<?= Html::encode($hero->name) ?>">
                        <?php else: ?>
                            <div class="no-photo"><i class="fa fa-user"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="hero-info">
                        <h4><?= Html::encode($hero->name) ?></h4>
                        <p class="hero-rank"><?= Html::encode($hero->rank) ?></p>
                        <?php if ($hero->death_date): ?>
                        <p class="hero-date">
                            <?= date('Y年', strtotime($hero->death_date)) ?>
                            <?php if ($hero->getAge()): ?>
                            （<?= $hero->getAge() ?>岁）
                            <?php endif; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 时间轴 -->
<div class="section timeline-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">历史时间轴</h2>
            <p class="section-subtitle">14年抗战的艰苦历程</p>
            <?= Html::a('查看完整时间轴 <i class="fa fa-arrow-right"></i>', ['/timeline/index'], ['class' => 'section-more']) ?>
        </div>
        
        <div class="timeline">
            <?php foreach ($timelineEvents as $index => $event): ?>
            <div class="timeline-item <?= $index % 2 == 0 ? 'left' : 'right' ?>">
                <div class="timeline-date">
                    <?= date('Y-m-d', strtotime($event->event_date)) ?>
                </div>
                <div class="timeline-content">
                    <h4><?= Html::encode($event->title) ?></h4>
                    <p><?= Html::encode(mb_substr($event->description, 0, 100, 'UTF-8')) ?>...</p>
                    <span class="timeline-category"><?= $event->getCategoryText() ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 纪念场馆 -->
<div class="section memorials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">纪念场馆</h2>
            <p class="section-subtitle">永远的纪念，永恒的缅怀</p>
            <?= Html::a('查看更多 <i class="fa fa-arrow-right"></i>', ['/memorial/index'], ['class' => 'section-more']) ?>
        </div>
        
        <div class="row">
            <?php foreach ($memorials as $memorial): ?>
            <div class="col-md-3 col-sm-6">
                <div class="memorial-card">
                    <?= Html::a('', ['/memorial/view', 'id' => $memorial->id], ['class' => 'memorial-link']) ?>
                    <div class="memorial-info">
                        <h4><?= Html::encode($memorial->name) ?></h4>
                        <p class="memorial-location">
                            <i class="fa fa-map-marker"></i>
                            <?= Html::encode($memorial->city) ?>
                        </p>
                        <span class="memorial-type"><?= $memorial->getTypeText() ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 抗战故事 -->
<div class="section stories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">抗战故事</h2>
            <p class="section-subtitle">真实的记忆，感人的瞬间</p>
            <?= Html::a('查看更多 <i class="fa fa-arrow-right"></i>', ['/story/index'], ['class' => 'section-more']) ?>
        </div>
        
        <div class="row">
            <?php foreach ($stories as $story): ?>
            <div class="col-md-4">
                <div class="story-card">
                    <?php if ($story->cover_image): ?>
                    <div class="story-image">
                        <img src="<?= $story->cover_image ?>" alt="<?= Html::encode($story->title) ?>">
                    </div>
                    <?php endif; ?>
                    <div class="story-content">
                        <span class="story-category"><?= $story->getCategoryText() ?></span>
                        <h4><?= Html::a(Html::encode($story->title), ['/story/view', 'id' => $story->id]) ?></h4>
                        <p class="story-summary">
                            <?= Html::encode(mb_substr($story->summary, 0, 100, 'UTF-8')) ?>...
                        </p>
                        <div class="story-meta">
                            <span><i class="fa fa-user"></i> <?= Html::encode($story->author) ?></span>
                            <span><i class="fa fa-eye"></i> <?= $story->views ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
/* 英雄横幅 */
.hero-banner {
    position: relative;
    height: 600px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%238B0000" width="1200" height="600"/></svg>') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-align: center;
    margin-bottom: 60px;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 64px;
    font-weight: bold;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-subtitle {
    font-size: 24px;
    margin-bottom: 30px;
    opacity: 0.9;
}

.hero-date {
    font-size: 48px;
    font-weight: bold;
    letter-spacing: 10px;
    margin-bottom: 40px;
}

.hero-buttons .btn {
    margin: 0 10px;
    padding: 15px 40px;
    font-size: 18px;
}

.btn-outline {
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
}

.btn-outline:hover {
    background: #fff;
    color: #8B0000;
}

/* 统计数据 */
.stats-section {
    background: #fff;
    padding: 60px 0;
    margin-bottom: 60px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.stat-box {
    text-align: center;
    padding: 30px;
}

.stat-icon {
    font-size: 48px;
    color: #d32f2f;
    margin-bottom: 20px;
}

.stat-number {
    font-size: 48px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.stat-label {
    font-size: 18px;
    color: #666;
}

/* 通用区块样式 */
.section {
    padding: 60px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
    position: relative;
}

.section-title {
    font-size: 42px;
    font-weight: bold;
    color: #d32f2f;
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 18px;
    color: #666;
}

.section-more {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #d32f2f;
    font-size: 16px;
}

.section-more:hover {
    text-decoration: none;
    color: #8B0000;
}

/* 战役卡片 */
.battle-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.battle-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.battle-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.battle-result {
    padding: 5px 15px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 12px;
    color: #fff;
    white-space: nowrap;
}

.battle-result.result-victory {
    background: #4caf50;
}

.battle-result.result-defeat {
    background: #f44336;
}

.battle-result.result-stalemate {
    background: #ff9800;
}

.battle-info {
    padding: 20px;
}

.battle-info h3 {
    font-size: 20px;
    margin: 0 0 15px 0;
}

.battle-info h3 a {
    color: #333;
    text-decoration: none;
}

.battle-info h3 a:hover {
    color: #d32f2f;
}

.battle-meta {
    margin-bottom: 15px;
    font-size: 14px;
    color: #666;
}

.battle-meta span {
    margin-right: 15px;
}

.battle-meta i {
    color: #d32f2f;
    margin-right: 5px;
}

.battle-desc {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}

/* 英雄卡片 */
.heroes-section {
    background: #fff;
}

.hero-card {
    position: relative;
    text-align: center;
    padding: 20px;
    margin-bottom: 30px;
    background: #f9f9f9;
    border-radius: 8px;
    transition: all 0.3s;
}

.hero-card:hover {
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.hero-link {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
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
    margin: 0 0 5px 0;
    color: #333;
}

.hero-rank {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}

.hero-date {
    font-size: 13px;
    color: #999;
}

/* 时间轴 */
.timeline-section {
    background: #f5f5f5;
}

.timeline {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 0;
}

.timeline::before {
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

.timeline-date {
    display: inline-block;
    padding: 8px 20px;
    background: #d32f2f;
    color: #fff;
    border-radius: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.timeline-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-content h4 {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px 0;
    color: #333;
}

.timeline-content p {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.timeline-category {
    display: inline-block;
    padding: 3px 10px;
    background: #f0f0f0;
    border-radius: 12px;
    font-size: 12px;
    color: #666;
}

/* 纪念场馆 */
.memorial-card {
    position: relative;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: all 0.3s;
}

.memorial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.memorial-link {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.memorial-info {
    padding: 20px;
}

.memorial-info h4 {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px 0;
    color: #333;
}

.memorial-location {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.memorial-type {
    display: inline-block;
    padding: 3px 12px;
    background: #d32f2f;
    color: #fff;
    border-radius: 12px;
    font-size: 12px;
}

/* 故事卡片 */
.stories-section {
    background: #fff;
}

.story-card {
    background: #f9f9f9;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 30px;
    transition: all 0.3s;
}

.story-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.story-image {
    height: 200px;
    overflow: hidden;
}

.story-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.story-content {
    padding: 20px;
}

.story-category {
    display: inline-block;
    padding: 3px 10px;
    background: #d32f2f;
    color: #fff;
    border-radius: 12px;
    font-size: 12px;
    margin-bottom: 10px;
}

.story-content h4 {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px 0;
}

.story-content h4 a {
    color: #333;
    text-decoration: none;
}

.story-content h4 a:hover {
    color: #d32f2f;
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

.story-meta i {
    margin-right: 5px;
}
</style>
