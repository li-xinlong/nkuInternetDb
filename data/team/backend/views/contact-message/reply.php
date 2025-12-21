<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactMessage */

$this->title = '回复留言 #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '留言管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-message-reply">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>留言内容</strong></div>
        <div class="panel-body">
            <?= Html::encode($model->body) ?>
            <div class="text-muted small">留言时间：<?= date('Y-m-d H:i', $model->created_at) ?></div>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'reply')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('保存回复', ['class' => 'btn btn-success']) ?>
            <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-default']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

