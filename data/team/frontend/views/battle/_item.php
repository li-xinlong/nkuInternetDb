<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="battle-item-card" onclick="window.location.href='<?= Url::to(['/battle/view','id'=>$model->id]) ?>'">
    <h3 class="battle-title"><?= Html::encode($model->name) ?></h3>
    <div class="battle-meta">
        <?php if($model->location): ?>
            <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->location) ?></span>
        <?php endif; ?>
        <?php if($model->start_date): ?>
            <span><i class="fa fa-calendar"></i> <?= date('Y-m-d',strtotime($model->start_date)) ?></span>
        <?php endif; ?>
        <span class="label result-label <?= $model->result ?>"><?= $model->getResultText() ?></span>
    </div>
    <?php if($model->description): ?>
        <p class="battle-desc"><?= Html::encode(mb_substr(strip_tags($model->description),0,120,'UTF-8')) ?>...</p>
    <?php endif; ?>
</div>

<style scoped>
.battle-item-card{background:#fff;border-radius:6px;box-shadow:0 1px 4px rgba(0,0,0,.1);padding:18px;margin-bottom:24px;cursor:pointer;transition:.2s;}
.battle-item-card:hover{box-shadow:0 4px 12px rgba(0,0,0,.2);transform:translateY(-3px);}
.battle-title{margin:0 0 10px;font-size:20px;color:#333;}
.battle-meta{font-size:14px;color:#666;margin-bottom:10px;}
.battle-meta span{margin-right:15px;}
.battle-meta i{color:#d32f2f;margin-right:4px;}
.label.result-label{font-size:12px;padding:2px 8px;border-radius:12px;color:#fff;}
.label.victory{background:#4caf50;}
.label.defeat{background:#f44336;}
.label.stalemate{background:#ff9800;}
.battle-desc{font-size:14px;color:#555;line-height:1.6;margin:0;}
</style>