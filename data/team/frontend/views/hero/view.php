<?php
use yii\helpers\Html;

$this->title = $model->name;
?>

<div class="container">
    <div class="hero-detail">
        <div class="row">
            <div class="col-md-4">
                <div class="hero-photo-large">
                    <?php if ($model->photo): ?>
                        <img src="<?= $model->photo ?>" alt="<?= Html::encode($model->name) ?>" class="img-responsive">
                    <?php else: ?>
                        <div class="no-photo"><i class="fa fa-user"></i></div>
                    <?php endif; ?>
                </div>
                
                <div class="hero-basic-info">
                    <h2><?= Html::encode($model->name) ?></h2>
                    <?php if ($model->alias): ?>
                    <p class="alias">字号：<?= Html::encode($model->alias) ?></p>
                    <?php endif; ?>
                    
                    <table class="table table-bordered">
                        <?php if ($model->rank): ?>
                        <tr>
                            <th>军衔</th>
                            <td><?= Html::encode($model->rank) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>类别</th>
                            <td><span class="label label-danger"><?= $model->getCategoryText() ?></span></td>
                        </tr>
                        <?php if ($model->birthplace): ?>
                        <tr>
                            <th>籍贯</th>
                            <td><?= Html::encode($model->birthplace) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->birth_date): ?>
                        <tr>
                            <th>出生</th>
                            <td><?= date('Y年m月d日', strtotime($model->birth_date)) ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->death_date): ?>
                        <tr>
                            <th>牺牲</th>
                            <td class="text-danger">
                                <strong><?= date('Y年m月d日', strtotime($model->death_date)) ?></strong>
                                <?php if ($model->getAge()): ?>
                                <br>享年 <?= $model->getAge() ?> 岁
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($model->unit): ?>
                        <tr>
                            <th>所属部队</th>
                            <td><?= Html::encode($model->unit) ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            
            <div class="col-md-8">
                <?php if ($model->biography): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-book"></i> 人物传记</h3>
                    <div class="content">
                        <?= nl2br(Html::encode($model->biography)) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($model->major_battles): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-crosshairs"></i> 参与战役</h3>
                    <div class="content">
                        <?= nl2br(Html::encode($model->major_battles)) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($model->honors): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-trophy"></i> 荣誉勋章</h3>
                    <div class="content">
                        <?= nl2br(Html::encode($model->honors)) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($model->famous_quotes): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-quote-left"></i> 名言警句</h3>
                    <div class="content quote">
                        <?= nl2br(Html::encode($model->famous_quotes)) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($model->sacrifice_location): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-map-marker"></i> 牺牲地点</h3>
                    <div class="content">
                        <?= Html::encode($model->sacrifice_location) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($model->memorial_location): ?>
                <div class="detail-section">
                    <h3><i class="fa fa-building"></i> 纪念地</h3>
                    <div class="content">
                        <?= Html::encode($model->memorial_location) ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="back-btn">
            <?= Html::a('<i class="fa fa-arrow-left"></i> 返回英雄列表', ['/hero/index'], ['class' => 'btn btn-lg btn-danger']) ?>
        </div>
    </div>
</div>

<style>
.hero-detail {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px 0;
}

.hero-photo-large {
    margin-bottom: 20px;
    border: 3px solid #d32f2f;
    border-radius: 8px;
    overflow: hidden;
    background: #f0f0f0;
}

.hero-photo-large img {
    width: 100%;
}

.no-photo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    font-size: 100px;
    color: #ccc;
}

.hero-basic-info {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}

.hero-basic-info h2 {
    font-size: 32px;
    font-weight: bold;
    color: #d32f2f;
    margin: 0 0 10px 0;
    text-align: center;
}

.alias {
    text-align: center;
    color: #666;
    margin-bottom: 20px;
}

.detail-section {
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #eee;
}

.detail-section:last-child {
    border-bottom: none;
}

.detail-section h3 {
    font-size: 24px;
    color: #d32f2f;
    margin-bottom: 15px;
}

.detail-section h3 i {
    margin-right: 10px;
}

.detail-section .content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

.content.quote {
    font-style: italic;
    background: #f9f9f9;
    padding: 20px;
    border-left: 4px solid #d32f2f;
}

.back-btn {
    text-align: center;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}
</style>
