<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
/* @var $messages common\models\ContactMessage[] */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\HtmlPurifier;

$this->title = '联系我们';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact container">
    <h1 class="mb-4 text-center"><?= Html::encode($this->title) ?></h1>

    <p class="lead text-center">下面是本项目团队成员介绍，如有任何问题或建议，欢迎给我们留言！</p>

    <!-- 团队成员卡片 -->
    <div class="row justify-content-center">
        <div class="col-lg-5 col-lg-offset-4 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">团队成员</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>安怡然</strong> - 南开大学 2022 级计算机专业<br>
                            <span class="text-muted">Email: 2483779035@qq.com</span>
                        </li>
                        <li class="list-group-item">
                            <strong>房书睿</strong> - 南开大学 2022 级信息安全与法学双学位专业<br>
                            <span class="text-muted">Email: 2374281437@qq.com</span>
                        </li>
                        <li class="list-group-item">
                            <strong>李欣龙</strong> - 南开大学 2022 级计算机专业<br>
                            <span class="text-muted">Email: lixlgood@foxmail.com</span>
                        </li>
                        <li class="list-group-item">
                            <strong>延嵩</strong> - 南开大学 2022 级信息安全专业<br>
                            <span class="text-muted">Email: 18302249825@163.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- 留言表单 -->
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-5 col-lg-offset-4 col-md-8">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'body')->label('留言内容')->textarea(['rows' => 6]) ?>

                <div class="form-group mt-3 text-center">
                    <?= Html::submitButton('发送留言', ['class' => 'btn btn-primary w-50', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <!-- 我的留言列表 -->
    <?php if ($messages): ?>
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5 col-lg-offset-4 col-md-8">
                <h4>我的留言</h4>
                <ul class="list-group">
                    <?php foreach ($messages as $msg): ?>
                        <li class="list-group-item">
                            <div class="small text-muted mb-1">留言时间：<?= date('Y-m-d H:i', $msg->created_at) ?></div>
                            <p><?= HtmlPurifier::process(Html::encode($msg->body)) ?></p>
                            <?php if ($msg->reply): ?>
                                <div class="border-top pt-2 text-success">
                                    <div class="small text-muted">管理员回复（<?= date('Y-m-d H:i', $msg->replied_at) ?>）：</div>
                                    <p class="mb-0"><?= HtmlPurifier::process(Html::encode($msg->reply)) ?></p>
                                </div>
                            <?php else: ?>
                                <div class="small text-muted">（尚未回复）</div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

</div>
