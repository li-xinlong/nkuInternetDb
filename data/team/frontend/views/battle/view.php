<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/**
 * @var \yii\web\View $this
 * @var \common\models\Battle $model
 * @var \common\models\Guestbook $commentModel
 * @var \yii\data\ActiveDataProvider $commentDataProvider
 */

$this->title = $model->name;
?>

<div class="container">
    <div class="battle-detail">
        <!-- 头部 -->
        <div class="detail-header">
            <h1><?= Html::encode($model->name) ?></h1>
            <?php if ($model->english_name): ?>
            <p class="english-name"><?= Html::encode($model->english_name) ?></p>
            <?php endif; ?>
            <div class="header-meta">
                <span class="badge badge-<?= $model->result ?>"><?= $model->getResultText() ?></span>
                <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->location) ?></span>
                <span><i class="fa fa-calendar"></i> 
                    <?= date('Y年m月d日', strtotime($model->start_date)) ?> 
                    - 
                    <?= date('Y年m月d日', strtotime($model->end_date)) ?>
                </span>
                <?php if ($model->duration_days): ?>
                <span><i class="fa fa-clock-o"></i> 持续 <?= $model->duration_days ?> 天</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <!-- 主要内容 -->
            <div class="col-md-8">
                <div class="detail-section">
                    <h2><i class="fa fa-book"></i> 战役概述</h2>
                    <div class="content">
                        <?= nl2br(Html::encode($model->description)) ?>
                    </div>
                </div>

                <?php if ($model->significance): ?>
                <div class="detail-section">
                    <h2><i class="fa fa-star"></i> 历史意义</h2>
                    <div class="content">
                        <?= nl2br(Html::encode($model->significance)) ?>
                    </div>
                </div>
                <?php endif; ?>


            </div>

            <!-- 侧边栏 -->
            <div class="col-md-4">
                <div class="sidebar-box">
                    <h3>战役数据</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>中方指挥官</th>
                            <td><?= Html::encode($model->commander_cn) ?></td>
                        </tr>
                        <tr>
                            <th>日方指挥官</th>
                            <td><?= Html::encode($model->commander_jp) ?></td>
                        </tr>
                        <?php if ($model->troops_cn): ?>
                        <tr>
                            <th>中方兵力</th>
                            <td><?= number_format($model->troops_cn) ?> 人</td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->troops_jp): ?>
                        <tr>
                            <th>日方兵力</th>
                            <td><?= number_format($model->troops_jp) ?> 人</td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->casualties_cn): ?>
                        <tr>
                            <th>中方伤亡</th>
                            <td class="text-danger"><strong><?= number_format($model->casualties_cn) ?> 人</strong></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->casualties_jp): ?>
                        <tr>
                            <th>日方伤亡</th>
                            <td><?= number_format($model->casualties_jp) ?> 人</td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="sidebar-box">
                    <h3>相关链接</h3>
                    <ul class="list-unstyled">
                        <li><?= Html::a('<i class="fa fa-arrow-left"></i> 返回战役列表', ['/battle/index'], ['class' => 'btn btn-block btn-default']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.battle-detail {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px 0;
}

.detail-header {
    text-align: center;
    padding-bottom: 30px;
    border-bottom: 3px solid #d32f2f;
    margin-bottom: 30px;
}

.detail-header h1 {
    font-size: 42px;
    font-weight: bold;
    color: #d32f2f;
    margin: 0 0 10px 0;
}

.english-name {
    font-size: 24px;
    color: #666;
    margin-bottom: 20px;
}

.header-meta {
    font-size: 16px;
}

.header-meta span {
    margin: 0 15px;
}

.header-meta i {
    margin-right: 5px;
}

.detail-image {
    margin-bottom: 30px;
}

.detail-image img {
    border-radius: 8px;
}

.detail-section {
    margin-bottom: 40px;
}

.detail-section h2 {
    font-size: 28px;
    color: #d32f2f;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #d32f2f;
}

.detail-section h2 i {
    margin-right: 10px;
}

.detail-section .content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

.sidebar-box {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.sidebar-box h3 {
    font-size: 20px;
    font-weight: bold;
    color: #d32f2f;
    margin: 0 0 15px 0;
}

.sidebar-box .table {
    margin-bottom: 0;
}

.sidebar-box .table th {
    background: #f0f0f0;
    font-weight: normal;
    width: 40%;
}

/* 评论区域样式 */
.comment-form-box {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.battle-comment-list {
    margin-top: 10px;
}

.battle-comment-item {
    display: flex;
    margin-bottom: 20px;
}

.comment-avatar {
    margin-right: 15px;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #d32f2f;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
}

.comment-body {
    flex: 1;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.comment-name {
    font-weight: bold;
    color: #333;
}

.comment-time {
    font-size: 12px;
    color: #999;
}

.comment-content {
    font-size: 14px;
    color: #444;
    line-height: 1.6;
}

.comment-actions {
    margin-top: 5px;
}

.comment-actions .comment-like {
    font-size: 13px;
    color: #d32f2f;
    text-decoration: none;
}

.comment-actions .comment-like:hover {
    text-decoration: underline;
}
</style>
