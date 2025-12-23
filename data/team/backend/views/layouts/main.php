<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .wrap {
            display: flex;
            min-height: calc(100vh - 60px);
        }
        .sidebar {
            width: 220px;
            background-color: #f4f4f4;
            border-right: 1px solid #ddd;
            padding: 15px;
        }
        .sidebar-header {
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .content-area {flex-grow:1; padding:20px;}
        .nav-pills.nav-stacked>li>a{color:#333;border-radius:4px;}
        .nav-pills.nav-stacked>li.active>a, .nav-pills.nav-stacked>li>a:hover{background:#337ab7;color:#fff;}
        .nav-header{padding:10px 0 5px;font-weight:bold;color:#777;text-transform:uppercase;font-size:12px;}
        .logout-btn-wrapper{margin-top:auto;padding-top:20px;}
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="sidebar">
        <div class="sidebar-header">
            抗战纪念网后台
        </div>
        <?php
        $controllerId = Yii::$app->controller->id;
        echo \yii\bootstrap\Nav::widget([
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '访问量统计', 'url' => ['/site/index'], 'active' => $controllerId === 'site'],
                '<li class="nav-header">管理模块</li>',
                ['label' => '资源管理', 'url' => ['/battle/index'], 'active' => in_array($controllerId, ['battle','memorial','hero'])],
                ['label' => '故事评论审批', 'url' => ['/guestbook/index', 'GuestbookSearch[related_model]'=>'story'], 'active' => $controllerId==='guestbook'],
                ['label' => '故事审批', 'url' => ['/story/index'], 'active' => $controllerId==='story'],
                ['label' => '留言管理', 'url' => ['/contact-message/index'], 'active' => $controllerId==='contact-message'],
                ['label' => '下载', 'url' => ['/download/index'], 'active' => $controllerId==='download'],
            ],
        ]);
        ?>
        <div class="logout-btn-wrapper">
            <?php if(!Yii::$app->user->isGuest): ?>
                <?= Html::beginForm(['/site/logout'],'post') ?>
                <?= Html::submitButton('退出 ('.Yii::$app->user->identity->username.')',['class'=>'btn btn-default btn-block']) ?>
                <?= Html::endForm() ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="content-area">
        <div class="container-fluid">
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'] ?? []]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; 抗战纪念网后台 <?= date('Y') ?> | 致敬先烈</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>