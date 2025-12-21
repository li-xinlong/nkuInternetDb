<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = '纪念场馆';
?>
<div class="container memorial-page">
    <div class="page-header-custom text-center">
        <h1><i class="fa fa-building"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead">永远的纪念 · 永恒的缅怀</p>
    </div>

    <div class="search-bar">
        <?php Pjax::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= Html::beginForm(['index'], 'get', ['data-pjax' => '']) ?>
                <div class="input-group input-group-lg">
                    <?= Html::textInput('keyword', $keyword ?? '', [
                        'class' => 'form-control',
                        'placeholder' => '搜索场馆名称...'
                    ]) ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-danger']) ?>
                    </span>
                </div>
                <?= Html::endForm() ?>
            </div>
            <div class="col-md-6 text-right">
                <?php
                $types = [
                    ''          => '全部',
                    'museum'    => '纪念馆',
                    'monument'  => '纪念碑',
                    'site'      => '遗址',
                    'cemetery'  => '烈士陵园',
                ];
                foreach ($types as $tKey => $tLabel) {
                    echo Html::a($tLabel, array_merge(['index'], $tKey ? ['type' => $tKey] : []), [
                        'class' => 'btn btn-lg ' . (($type ?? '') == $tKey ? 'btn-danger' : 'btn-default'),
                    ]);
                }
                ?>
            </div>
        </div>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView'     => '_item',
            'layout'       => '<div class="memorial-list">{items}</div><div class="text-center">{pager}</div>',
            'itemOptions'  => ['tag' => false], // _item itself contains full markup
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>

<style>
.page-header-custom{padding:40px 0;border-bottom:3px solid #d32f2f;margin-bottom:40px;}
.page-header-custom h1{font-size:48px;color:#d32f2f;margin-bottom:10px;}

.search-bar{background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.1);margin-bottom:30px;}

/* 三列瀑布布局 */
.memorial-list{column-count:3;column-gap:20px;}
.memorial-item-card{display:inline-block;width:100%;margin:0 0 20px;}
@media(max-width:992px){.memorial-list{column-count:2;}}
@media(max-width:576px){.memorial-list{column-count:1;}}
</style>
