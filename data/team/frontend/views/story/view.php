<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/** @var \yii\web\View $this */
/** @var \common\models\Story $model */
/** @var \common\models\Guestbook $commentModel */
/** @var \yii\data\ActiveDataProvider $commentDataProvider */

$this->title = $model->title;
?>

<div class="container">
    <div class="story-detail">
        <h1><?= Html::encode($model->title) ?></h1>
        
        <div class="story-meta-header">
            <span class="label label-danger"><?= $model->getCategoryText() ?></span>
            <?php if ($model->author): ?>
            <span><i class="fa fa-user"></i> <?= Html::encode($model->author) ?></span>
            <?php endif; ?>


            <a href="<?= Url::to(['/story/like-story', 'id' => $model->id]) ?>" class="story-like-btn">
                <i class="fa fa-thumbs-up"></i>
                <span>赞</span>
                <span class="like-count">(<?= $model->getLikeCount() ?>)</span>
            </a>
        </div>

        <?php if ($model->cover_image): ?>
        <div class="story-cover">
            <img src="<?= $model->cover_image ?>" alt="<?= Html::encode($model->title) ?>" class="img-responsive">
        </div>
        <?php endif; ?>

        <?php if ($model->summary): ?>
        <div class="story-summary">
            <strong>摘要：</strong><?= Html::encode($model->summary) ?>
        </div>
        <?php endif; ?>

        <div class="story-content">
            <?= nl2br(Html::encode($model->content)) ?>
        </div>

        <!-- 评论区 -->
        <div class="detail-section" id="story-comments">
            <h2><i class="fa fa-comments"></i> 故事评论区</h2>
            
            <div class="comment-form-box">
                <?php if (Yii::$app->user->isGuest): ?>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        请先 <?= Html::a('登录', ['/site/login', 'returnUrl' => Yii::$app->request->url]) ?> 后才能发表评论和点赞。
                    </div>
                <?php else: ?>
                    <p class="text-muted">
                        <i class="fa fa-user"></i>
                        当前登录用户：<strong><?= Html::encode(Yii::$app->user->identity->username) ?></strong>
                    </p>
                    <?php $form = ActiveForm::begin(['action' => ['story/view', 'id' => $model->id, '#' => 'story-comments']]); ?>
                    <?= $form->field($commentModel, 'content')->textarea(['rows' => 4, 'placeholder' => '写下你的读后感...'])->label(false) ?>
                    <div class="form-group text-right">
                        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> 发表评论', ['class' => 'btn btn-danger']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            </div>

            <div class="comment-list-box">
                <?= ListView::widget([
                    'dataProvider' => $commentDataProvider,
                    'itemView' => '_comment_item',
                    'layout' => "{items}\n{pager}",
                    'emptyText' => '<p class="text-muted">还没有人评论，快来抢沙发吧！</p>',
                ]) ?>
            </div>
        </div>

        <div class="back-btn">
            <?= Html::a('<i class="fa fa-arrow-left"></i> 返回故事列表', ['/story/index'], ['class' => 'btn btn-lg btn-danger']) ?>
        </div>
    </div>
</div>

<style>
.story-detail {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px 0;
}

.story-detail h1 {
    font-size: 36px;
    font-weight: bold;
    color: #d32f2f;
    margin-bottom: 20px;
    text-align: center;
}

.story-meta-header {
    text-align: center;
    padding-bottom: 20px;
    margin-bottom: 30px;
    border-bottom: 2px solid #eee;
    font-size: 14px;
    color: #666;
}

.story-meta-header span {
    margin: 0 15px;
}

.story-cover {
    text-align: center;
    margin-bottom: 30px;
}

.story-cover img {
    border-radius: 8px;
    max-width: 100%;
}

.story-summary {
    background: #f9f9f9;
    padding: 20px;
    border-left: 4px solid #d32f2f;
    margin-bottom: 30px;
    font-size: 16px;
    line-height: 1.8;
}

.story-content {
    font-size: 16px;
    line-height: 2;
    color: #333;
    text-align: justify;
}

.back-btn {
    text-align: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}
</style>
