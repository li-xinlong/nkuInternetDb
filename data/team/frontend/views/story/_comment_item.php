<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\Guestbook $model */
?>

<div class="comment-item" id="comment-<?= $model->id ?>">
    
    <div class="comment-body">
        <div class="comment-header">
            <span class="comment-name"><?= Html::encode($model->name) ?></span>
            <span class="comment-time"><?= date('Y-m-d H:i', $model->created_at) ?></span>
        </div>
        <div class="comment-content">
            <?= nl2br(Html::encode($model->content)) ?>
        </div>
        <div class="comment-actions">
            <a href="<?= Url::to(['/story/like-comment', 'id' => $model->id]) ?>" class="comment-like-btn">
                <i class="fa fa-thumbs-o-up"></i>
                <span>赞</span>
                <span class="like-count">(<?= (int)$model->likeCount ?>)</span>
            </a>
        </div>
    </div>
</div>
