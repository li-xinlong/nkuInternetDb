<?php
// 1. 定义Yii调试模式和环境
define('YII_DEBUG', true);
define('YII_ENV', 'dev');

// 2. 加载自动加载器和Yii核心文件
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// 3. 加载控制台配置（用控制台应用更稳定）
$config = require __DIR__ . '/console/config/main.php';
new yii\console\Application($config);

// 4. 生成admin密码的bcrypt哈希
$newHash = Yii::$app->security->generatePasswordHash('admin');
echo "新的admin密码哈希: " . $newHash . "\n";

// 5. 更新数据库中的密码哈希
$db = Yii::$app->db;
$db->createCommand()->update(
    'user',
    ['password_hash' => $newHash],
    ['username' => 'admin']
)->execute();
echo "数据库密码哈希已更新\n";

// 6. 重新验证
$user = $db->createCommand('SELECT password_hash FROM user WHERE username = "admin"')->queryOne();
if ($user) {
    $isValid = Yii::$app->security->validatePassword('admin', $user['password_hash']);
    echo "更新后密码验证结果: " . ($isValid ? "正确" : "错误") . "\n";
}