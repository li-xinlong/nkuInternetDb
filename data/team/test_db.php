<?php
// 测试数据库连接
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// 定义 Yii 2 高级版的环境常量（必须，否则配置加载会出错）
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', true);

// 加载 Yii 2 高级版的公共配置（主配置 + 本地配置）
$commonMain = require __DIR__ . '/common/config/main.php';
$commonLocal = require __DIR__ . '/common/config/main-local.php';
$commonConfig = array_merge($commonMain, $commonLocal);

// 可选：加载前端/后端配置（如果 db 配置在前端/后端）
// $frontendMain = require __DIR__ . '/frontend/config/main.php';
// $frontendLocal = require __DIR__ . '/frontend/config/main-local.php';
// $frontendConfig = array_merge($frontendMain, $frontendLocal);

// 创建应用，传入合并后的配置
$app = new yii\console\Application(array_merge($commonConfig, [
    'id' => 'test-app',
    'basePath' => __DIR__,
]));

try {
    $db = Yii::$app->db;
    echo "数据库连接测试:\n";
    echo "DSN: " . $db->dsn . "\n";
    echo "用户名: " . $db->username . "\n";
    echo "状态: ";
    
    $db->open();
    echo "连接成功!\n";
    
    // 后续查询逻辑不变...
} catch (Exception $e) {
    echo "连接失败: " . $e->getMessage() . "\n";
} finally {
    $app->end();
}