<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?> - 中国抗战胜利80周年纪念</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: "Microsoft YaHei", Arial, sans-serif;
            background: #f5f5f5;
        }
        
        /* 顶部导航 */
        .top-bar {
            background: #8B0000;
            color: #fff;
            padding: 10px 0;
            font-size: 14px;
        }
        
        .top-bar a {
            color: #fff;
            margin-left: 20px;
        }
        
        /* 主导航 */
        .main-nav {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #d32f2f !important;
        }
        
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        
        .navbar-nav > li > a {
            font-size: 16px;
            padding: 20px 20px;
            color: #333 !important;
            transition: all 0.3s;
        }
        
        .navbar-nav > li > a:hover,
        .navbar-nav > li.active > a {
            color: #d32f2f !important;
            background: #fff !important;
            border-bottom: 3px solid #d32f2f;
        }
        
        /* 页脚 */
        .footer {
            background: #333;
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .footer h4 {
            color: #d32f2f;
            margin-bottom: 20px;
        }
        
        .footer a {
            color: #ccc;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: #fff;
        }
        
        .footer-bottom {
            border-top: 1px solid #555;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            color: #999;
        }
        
        /* 内容区域 */
        .content-wrapper {
            min-height: calc(100vh - 400px);
            padding: 30px 0;
        }
    </style>
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- 顶部栏 -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <i class="fa fa-calendar"></i> 纪念中国人民抗日战争暨世界反法西斯战争胜利80周年
            </div>
            <div class="col-md-6 text-right">
                <a href="<?= Url::to(['/site/about']) ?>"><i class="fa fa-info-circle"></i> 关于我们</a>
                <a href="<?= Url::to(['/site/contact']) ?>"><i class="fa fa-envelope"></i> 联系我们</a>
            </div>
        </div>
    </div>
</div>

<!-- 主导航 -->
<nav class="navbar navbar-default main-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= Html::a('<i class="fa fa-flag"></i> 抗战纪念馆', ['/site/index'], ['class' => 'navbar-brand']) ?>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-home"></i> 首页', ['/site/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'battle' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-crosshairs"></i> 抗战战役', ['/battle/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'hero' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-user"></i> 英雄人物', ['/hero/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'memorial' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-building"></i> 纪念场馆', ['/memorial/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'weapon' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-shield"></i> 武器装备', ['/weapon/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'timeline' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-clock-o"></i> 历史时间轴', ['/timeline/index']) ?>
                </li>
                <li class="<?= Yii::$app->controller->id == 'story' ? 'active' : '' ?>">
                    <?= Html::a('<i class="fa fa-book"></i> 抗战故事', ['/story/index']) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- 内容区域 -->
<div class="content-wrapper">
    <?= $content ?>
</div>

<!-- 页脚 -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4>关于我们</h4>
                <p>铭记历史，缅怀先烈，珍爱和平，开创未来。</p>
                <p>纪念中国人民抗日战争暨世界反法西斯战争胜利80周年。</p>
            </div>
            <div class="col-md-3">
                <h4>快速链接</h4>
                <ul class="list-unstyled">
                    <li><?= Html::a('抗战战役', ['/battle/index']) ?></li>
                    <li><?= Html::a('英雄人物', ['/hero/index']) ?></li>
                    <li><?= Html::a('纪念场馆', ['/memorial/index']) ?></li>
                    <li><?= Html::a('历史时间轴', ['/timeline/index']) ?></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>资源中心</h4>
                <ul class="list-unstyled">
                    <li><?= Html::a('武器装备', ['/weapon/index']) ?></li>
                    <li><?= Html::a('抗战故事', ['/story/index']) ?></li>
                    <li><?= Html::a('多媒体资料', ['/media/index']) ?></li>
                    <li><?= Html::a('留言板', ['/guestbook/index']) ?></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>联系我们</h4>
                <p><i class="fa fa-envelope"></i> memorial@example.com</p>
                <p><i class="fa fa-phone"></i> 010-12345678</p>
                <p><i class="fa fa-map-marker"></i> 北京市某某区某某路</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> 中国抗战胜利80周年纪念网站. 保留所有权利.</p>
            <p>勿忘国耻 | 吾辈自强 | 振兴中华</p>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
