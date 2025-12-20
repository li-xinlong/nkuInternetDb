<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = '抗战战役';
?>

<div class="container">
    <div class="page-header-custom">
        <h1><i class="fa fa-crosshairs"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">血与火的洗礼，民族精神的丰碑</p>
    </div>

    <!-- 搜索筛选 -->
    <div class="search-bar">
        <?php Pjax::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= Html::beginForm(['index'], 'get', ['data-pjax' => '']) ?>
                <div class="input-group input-group-lg">
                    <?= Html::textInput('keyword', $keyword, [
                        'class' => 'form-control',
                        'placeholder' => '搜索战役名称...'
                    ]) ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-danger']) ?>
                    </span>
                </div>
                <?= Html::endForm() ?>
            </div>
            <div class="col-md-6">
                <div class="filter-btns">
                    <?= Html::a('全部', ['index'], [
                        'class' => 'btn btn-lg ' . (!$result ? 'btn-danger' : 'btn-default')
                    ]) ?>
                    <?= Html::a('胜利', ['index', 'result' => 'victory'], [
                        'class' => 'btn btn-lg ' . ($result == 'victory' ? 'btn-success' : 'btn-default')
                    ]) ?>
                    <?= Html::a('失败', ['index', 'result' => 'defeat'], [
                        'class' => 'btn btn-lg ' . ($result == 'defeat' ? 'btn-warning' : 'btn-default')
                    ]) ?>
                    <?= Html::a('僵持', ['index', 'result' => 'stalemate'], [
                        'class' => 'btn btn-lg ' . ($result == 'stalemate' ? 'btn-info' : 'btn-default')
                    ]) ?>
                </div>
            </div>
        </div>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'layout' => '<div class="row">{items}</div><div class="text-center">{pager}</div>',
            'itemOptions' => ['class' => 'col-md-4 col-sm-6'],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

<style>
.page-header-custom {
    text-align: center;
    padding: 40px 0;
    border-bottom: 3px solid #d32f2f;
    margin-bottom: 40px;
}

.page-header-custom h1 {
    font-size: 48px;
    color: #d32f2f;
    margin-bottom: 10px;
}

.search-bar {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.filter-btns {
    text-align: right;
}

.filter-btns .btn {
    margin-left: 10px;
}
</style>
