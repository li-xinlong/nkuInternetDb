<?php
use yii\helpers\Html;

$this->title = $model->name;
?>

<div class="container">
    <div class="memorial-detail">
        <div class="detail-header">
            <h1><?= Html::encode($model->name) ?></h1>
            <div class="header-meta">
                <span class="badge badge-danger"><?= $model->getTypeText() ?></span>
                <?php if ($model->city): ?>
                <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->province) ?> <?= Html::encode($model->city) ?></span>
                <?php endif; ?>
                <?php if ($model->established_date): ?>
                <span><i class="fa fa-calendar"></i> 建立于 <?= date('Y年', strtotime($model->established_date)) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?php if ($model->cover_image): ?>
                <div class="detail-image">
                    <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->name) ?>" class="img-responsive">
                </div>
                <?php endif; ?>

                <?php if ($model->description): ?>
                <div class="detail-section">
                    <h2><i class="fa fa-info-circle"></i> 场馆简介</h2>
                    <div class="content">
                        <?= nl2br(Html::encode($model->description)) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($model->collections): ?>
                <div class="detail-section">
                    <h2><i class="fa fa-archive"></i> 馆藏文物</h2>
                    <div class="content">
                        <?= nl2br(Html::encode($model->collections)) ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="sidebar-box">
                    <h3>参观信息</h3>
                    <table class="table">
                        <?php if ($model->address): ?>
                        <tr>
                            <th><i class="fa fa-map-marker"></i> 地址</th>
                            <td><?= Html::encode($model->address) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->opening_hours): ?>
                        <tr>
                            <th><i class="fa fa-clock-o"></i> 开放时间</th>
                            <td><?= Html::encode($model->opening_hours) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->ticket_price !== null): ?>
                        <tr>
                            <th><i class="fa fa-ticket"></i> 门票</th>
                            <td>
                                <?php if ($model->ticket_price == 0): ?>
                                    <span class="text-success"><strong>免费</strong></span>
                                <?php else: ?>
                                    ¥<?= number_format($model->ticket_price, 2) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->contact_phone): ?>
                        <tr>
                            <th><i class="fa fa-phone"></i> 电话</th>
                            <td><?= Html::encode($model->contact_phone) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->website): ?>
                        <tr>
                            <th><i class="fa fa-globe"></i> 网站</th>
                            <td><?= Html::a('访问官网', $model->website, ['target' => '_blank']) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->area): ?>
                        <tr>
                            <th><i class="fa fa-arrows-alt"></i> 面积</th>
                            <td><?= number_format($model->area) ?> ㎡</td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="sidebar-box">
                    <?= Html::a('<i class="fa fa-arrow-left"></i> 返回列表', ['/memorial/index'], ['class' => 'btn btn-block btn-danger btn-lg']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.memorial-detail {
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
    margin: 0 0 20px 0;
}

.header-meta {
    font-size: 16px;
}

.header-meta span {
    margin: 0 15px;
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
    font-weight: normal;
    color: #666;
    width: 35%;
    border-top: none;
}

.sidebar-box .table td {
    border-top: none;
}
</style>
