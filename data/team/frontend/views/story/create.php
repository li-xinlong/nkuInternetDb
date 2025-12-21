<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Story */

$this->title = '分享您的抗战故事';
$this->params['breadcrumbs'][] = ['label' => '抗战故事', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>分享您知道的、或您亲身经历的抗战故事，让更多人了解那段历史。</p>

    <div class="story-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'category')->dropDownList([
            'memoir' => '回忆录',
            'legend' => '传奇',
            'diary' => '日记',
            'letter' => '家书',
            'other' => '其他',
        ], ['prompt' => '选择故事类别']) ?>

        <?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

        <div class="form-group">
            <?= Html::submitButton('提交审核', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>



