<?php
require './vendor/autoload.php';
require './vendor/yiisoft/yii2/Yii.php';

$config = yii\helpers\ArrayHelper::merge(
    require './common/config/main.php',
    require './common/config/main-local.php',
    require './console/config/main.php',
    require './console/config/main-local.php'
);

$app = new yii\console\Application($config);

echo "正在创建admin用户...\n";

// 生成密码哈希和认证密钥
$hash = Yii::$app->security->generatePasswordHash('admin');
$authKey = Yii::$app->security->generateRandomString();
$timestamp = time();

// 先删除可能存在的admin用户
Yii::$app->db->createCommand()
    ->delete('user', ['username' => 'admin'])
    ->execute();

echo "已清除旧的admin用户（如果存在）\n";

// 插入新用户
try {
    $result = Yii::$app->db->createCommand()
        ->insert('user', [
            'username' => 'admin',
            'auth_key' => $authKey,
            'password_hash' => $hash,
            'email' => 'admin@nankai.edu.cn',
            'status' => 10,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ])
        ->execute();
    
    if ($result) {
        echo "✓ admin用户创建成功！\n\n";
        
        // 查询验证
        $user = Yii::$app->db->createCommand(
            'SELECT id, username, email, status FROM user WHERE username = :username',
            [':username' => 'admin']
        )->queryOne();
        
        if ($user) {
            echo "用户信息:\n";
            echo "  ID: " . $user['id'] . "\n";
            echo "  用户名: " . $user['username'] . "\n";
            echo "  邮箱: " . $user['email'] . "\n";
            echo "  状态: " . $user['status'] . "\n";
        }
        
        echo "\n╔════════════════════════════════════╗\n";
        echo "║     管理员账号信息                 ║\n";
        echo "╠════════════════════════════════════╣\n";
        echo "║  用户名: admin                    ║\n";
        echo "║  密码: admin                      ║\n";
        echo "║  邮箱: admin@nankai.edu.cn        ║\n";
        echo "╚════════════════════════════════════╝\n";
        
    } else {
        echo "✗ 创建失败\n";
    }
} catch (Exception $e) {
    echo "✗ 错误: " . $e->getMessage() . "\n";
}