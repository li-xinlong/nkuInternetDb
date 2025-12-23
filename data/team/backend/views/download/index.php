<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '资源下载';
$this->params['breadcrumbs'][] = $this->title;

// 按类别分组
$personalFiles = array_filter($files, function($file) {
    return $file['category'] === 'personal';
});
$teamFiles = array_filter($files, function($file) {
    return $file['category'] === 'team';
});
?>

<div class="download-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <!-- 个人数据区域 -->
    <h3><i class="glyphicon glyphicon-user"></i> 个人作业</h3>
    <div class="row">
        <?php foreach ($personalFiles as $file): ?>
            <div class="col-md-6 col-lg-3" style="margin-bottom: 20px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            <?= Html::encode($file['name']) ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>路径：</strong><code style="font-size: 11px;"><?= Html::encode($file['path']) ?></code></p>
                        <p><strong>说明：</strong><?= Html::encode($file['description']) ?></p>
                        
                        <div style="margin-top: 15px;">
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-download-alt"></i> 下载', 
                                ['download', 'id' => $file['id']], 
                                [
                                    'class' => 'btn btn-success btn-block btn-sm',
                                    'data-method' => 'post',
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 团队作业区域 -->
    <h3 style="margin-top: 30px;"><i class="glyphicon glyphicon-briefcase"></i> 团队作业</h3>
    <div class="row">
        <?php foreach ($teamFiles as $file): ?>
            <div class="col-md-6" style="margin-bottom: 20px;">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="glyphicon glyphicon-<?= $file['id'] === 'team-code' ? 'console' : 'book' ?>"></i>
                            <?= Html::encode($file['name']) ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>路径：</strong><code><?= Html::encode($file['path']) ?></code></p>
                        <p><strong>说明：</strong><?= Html::encode($file['description']) ?></p>
                        
                        <div style="margin-top: 15px;">
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-download-alt"></i> 下载 ZIP 压缩包', 
                                ['download', 'id' => $file['id']], 
                                [
                                    'class' => 'btn btn-danger btn-block',
                                    'data-method' => 'post',
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="panel-footer text-muted">
                        <small>
                            <i class="glyphicon glyphicon-<?= $file['id'] === 'team-code' ? 'warning-sign' : 'info-sign' ?>"></i>
                            <?php if ($file['id'] === 'team-code'): ?>
                                注意：代码文件夹较大，下载需要较长时间，为节省时间vendor等依赖文件不进行下载
                            <?php else: ?>
                                包含项目文档
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="alert alert-info">
        <strong><i class="glyphicon glyphicon-info-sign"></i> 提示：</strong>
        <ul style="margin-bottom: 0; margin-top: 10px;">
            <li>下载的文件将自动打包成 ZIP 压缩包</li>
            <li>压缩包内会保持原有的目录结构</li>
            <li>下载完成后临时文件会自动清理</li>
            <li><strong>团队作业代码</strong>：包含 backend 等子目录，已排除 vendor、node_modules 等大文件夹</li>
            <li><strong>团队作业文档</strong>：包含项目相关的所有文档资料</li>
        </ul>
    </div>
</div>

<style>
.panel-primary > .panel-heading {
    background-color: #b73333;
    border-color: #b76e33;
}
.panel-danger > .panel-heading {
    background-color: #c9302c;
    border-color: #ac2925;
    color: #fff;
}
.panel-danger {
    border-color: #d9534f;
}
.btn-danger {
    background-color: #d9534f;
    border-color: #d43f3a;
}
.btn-danger:hover {
    background-color: #c9302c;
    border-color: #ac2925;
}
.panel-footer {
    background-color: #f5f5f5;
}
</style>
