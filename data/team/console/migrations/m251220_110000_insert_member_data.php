<?php

use yii\db\Migration;

/**
 * 導入 member 測試數據（若表已有資料則自動跳過）。
 */
class m251220_110000_insert_member_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): bool
    {
        echo "开始导入会员测试数据...\n";

        // 若 member 表已經包含任何紀錄，直接跳過避免唯一索引衝突
        if ((new \yii\db\Query())->from('{{%member}}')->exists()) {
            echo "member 表已有資料，跳過測試數據插入。\n";
            return true;
        }

        // SQL文件路径
        $sqlFile = __DIR__ . '/member_data.sql';

        if (!file_exists($sqlFile)) {
            echo "SQL文件不存在，跳過会员数据导入（{$sqlFile}）\n";
            return true;
        }

        echo "找到SQL文件: {$sqlFile}\n开始读取文件...\n";

        $content = file_get_contents($sqlFile);
        if ($content === false) {
            echo "错误: 无法读取SQL文件\n";
            return false;
        }

        echo "文件大小: " . strlen($content) . " 字节\n";
        $db = $this->db;

        try {
            // 禁用外鍵
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
            echo "已禁用外键检查\n";

            // 移除註解
            $content = preg_replace('/--[^\n]*\n/', "\n", $content);
            $content = preg_replace('/\/\*.*?\*\//s', '', $content);

            // 拆分 SQL
            $statements = array_filter(array_map('trim', explode(';', $content)));
            echo "共有 " . count($statements) . " 条SQL语句\n开始执行...\n\n";

            foreach ($statements as $statement) {
                if (empty($statement)) continue;
                // 直接 IGNORE，避免重複鍵錯誤
                $statement = preg_replace('/^INSERT\s+INTO/i', 'INSERT IGNORE INTO', $statement, 1);
                $db->createCommand($statement)->execute();
            }

            // 啟用外鍵
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            echo "\n导入完成！\n";
            return true;
        } catch (\Throwable $e) {
            echo "执行过程中错误: " . $e->getMessage() . "\n";
            // 恢復外鍵
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool
    {
        echo "开始回滚（清空会员数据）...\n";
        $db = $this->db;
        try {
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
            $this->truncateTable('{{%member}}');
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            echo "会员数据已清空\n";
            return true;
        } catch (\Throwable $e) {
            echo "回滚错误: " . $e->getMessage() . "\n";
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            return false;
        }
    }
}
