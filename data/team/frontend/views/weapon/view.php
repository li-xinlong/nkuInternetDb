<?php
use yii\helpers\Html;

$this->title = $model->name;
?>

<div class="container">
    <div class="weapon-detail">
        <h1><?= Html::encode($model->name) ?></h1>
        
        <div class="row">
            <div class="col-md-6">
                <?php if ($model->image): ?>
                <div class="weapon-image">
                    <img src="<?= $model->image ?>" alt="<?= Html::encode($model->name) ?>" class="img-responsive">
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>型号</th>
                        <td><?= Html::encode($model->model) ?></td>
                    </tr>
                    <tr>
                        <th>类别</th>
                        <td><?= $model->getCategoryText() ?></td>
                    </tr>
                    <tr>
                        <th>生产国</th>
                        <td><?= Html::encode($model->country) ?></td>
                    </tr>
                    <?php if ($model->caliber): ?>
                    <tr>
                        <th>口径</th>
                        <td><?= Html::encode($model->caliber) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($model->weight): ?>
                    <tr>
                        <th>重量</th>
                        <td><?= $model->weight ?> kg</td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($model->range): ?>
                    <tr>
                        <th>射程</th>
                        <td><?= number_format($model->range) ?> m</td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        
        <?php if ($model->description): ?>
        <div class="detail-section">
            <h2>武器描述</h2>
            <div class="content">
                <?= nl2br(Html::encode($model->description)) ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="back-btn">
            <?= Html::a('<i class="fa fa-arrow-left"></i> 返回列表', ['/weapon/index'], ['class' => 'btn btn-lg btn-danger']) ?>
        </div>
    </div>
</div>

<style>
.weapon-detail {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px 0;
}

.weapon-detail h1 {
    text-align: center;
    color: #d32f2f;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 3px solid #d32f2f;
}

.weapon-image {
    text-align: center;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    margin-bottom: 20px;
}

.detail-section {
    margin-top: 30px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}

.detail-section h2 {
    font-size: 24px;
    color: #d32f2f;
    margin-bottom: 15px;
}

.detail-section .content {
    font-size: 16px;
    line-height: 1.8;
}

.back-btn {
    text-align: center;
    margin-top: 30px;
}
</style>
