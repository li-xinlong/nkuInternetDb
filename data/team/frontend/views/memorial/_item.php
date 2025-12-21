<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="memorial-item-card" onclick="window.location.href='<?= Url::to(['/memorial/view','id'=>$model->id]) ?>'">
    <h3 class="memorial-title"><?= Html::encode($model->name) ?></h3>
    <div class="memorial-meta">
        <?php if($model->city):?>
            <span><i class="fa fa-map-marker"></i> <?= Html::encode($model->city) ?></span>
        <?php endif; ?>
        <?php if($model->established_date):?>
            <span><i class="fa fa-calendar"></i> <?= date('Y年',strtotime($model->established_date)) ?></span>
        <?php endif; ?>
        <span class="memorial-type label label-default"><?= $model->getTypeText() ?></span>
    </div>
    <?php if($model->description):?>
        <p class="memorial-desc"><?= Html::encode(mb_substr(strip_tags($model->description),0,120,'UTF-8')) ?>...</p>
    <?php endif; ?>
</div>

<style scoped>
.memorial-item-card{background:#fff;border-radius:6px;box-shadow:0 1px 4px rgba(0,0,0,.1);padding:18px;margin-bottom:24px;cursor:pointer;transition:.2s;}
.memorial-item-card:hover{box-shadow:0 4px 12px rgba(0,0,0,.2);transform:translateY(-3px);}
.memorial-title{margin:0 0 10px;font-size:20px;color:#333;}
.memorial-meta{font-size:14px;color:#666;margin-bottom:10px;}
.memorial-meta span{margin-right:15px;}
.memorial-meta i{color:#d32f2f;margin-right:4px;}
.memorial-type{font-size:12px;background:#d32f2f;color:#fff;padding:2px 8px;border-radius:12px;}
.memorial-desc{font-size:14px;color:#555;line-height:1.6;margin:0;}
</style>