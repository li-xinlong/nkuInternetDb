<?php

use yii\db\Migration;

/**
 * 导入抗战纪念网站测试数据
 */
class m251220_100000_insert_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        echo "开始导入测试数据...\n";

        // 检查是否已有测试数据（通过检查 battle 表是否有数据）
        $hasData = (new \yii\db\Query())
            ->from('{{%battle}}')
            ->exists();
        
        if ($hasData) {
            echo "检测到数据库中已有测试数据，跳过导入以避免重复。\n";
            echo "如需重新导入，请先清空相关表的数据。\n";
            return true;
        }

        // SQL文件路径
        $sqlFile = __DIR__ . '/insert_data.sql';
        
        if (!file_exists($sqlFile)) {
            echo "错误: SQL文件不存在: {$sqlFile}\n";
            echo "请将 insert_data.sql 文件放到 console/migrations/ 目录下\n";
            return false;
        }

        echo "找到SQL文件: {$sqlFile}\n";
        echo "开始读取文件...\n";

        // 读取文件内容
        $content = file_get_contents($sqlFile);
        
        if ($content === false) {
            echo "错误: 无法读取SQL文件\n";
            return false;
        }

        echo "文件大小: " . strlen($content) . " 字节\n";

        // 使用数据库连接直接执行
        $db = $this->db;
        
        try {
            // 禁用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
            echo "已禁用外键检查\n";

            // 清理SQL内容
            // 移除SQL注释
            $content = preg_replace('/--[^\n]*\n/', "\n", $content);
            $content = preg_replace('/\/\*.*?\*\//s', '', $content);
            
            // 分割SQL语句
            $statements = explode(';', $content);
            $statements = array_filter(array_map('trim', $statements));
            
            echo "共有 " . count($statements) . " 条SQL语句\n";
            echo "开始执行...\n\n";

            $successCount = 0;
            $errorCount = 0;
            $currentTable = '';

            foreach ($statements as $index => $statement) {
                if (empty($statement)) {
                    continue;
                }

                // 检测当前操作的表
                if (preg_match('/INSERT INTO\s+`?(\w+)`?/i', $statement, $matches)) {
                    $table = $matches[1];
                    if ($table !== $currentTable) {
                        $currentTable = $table;
                        echo "\n正在插入数据到表: {$table}\n";
                    }
                }

                try {
                    // 将 INSERT INTO 替换为 INSERT IGNORE INTO，避免重复键错误
                    $statement = preg_replace('/^INSERT\s+INTO/i', 'INSERT IGNORE INTO', $statement, 1);
                    $db->createCommand($statement)->execute();
                    $successCount++;
                    
                    // 显示进度
                    if ($successCount % 5 == 0) {
                        echo ".";
                    }
                    if ($successCount % 50 == 0) {
                        echo " [{$successCount}]\n";
                    }
                    
                } catch (\Exception $e) {
                    $errorCount++;
                    echo "\n[错误 #{$errorCount}] ";
                    echo "语句 #" . ($index + 1) . ": " . $e->getMessage() . "\n";
                    
                    // 显示出错的SQL（前100个字符）
                    if (strlen($statement) > 100) {
                        echo "SQL: " . substr($statement, 0, 100) . "...\n";
                    } else {
                        echo "SQL: " . $statement . "\n";
                    }
                    
                    // 如果错误太多，停止执行
                    if ($errorCount > 10) {
                        echo "\n错误过多，停止执行\n";
                        break;
                    }
                }
            }

            // 启用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            echo "\n\n已启用外键检查\n";

            echo "\n" . str_repeat("=", 50) . "\n";
            echo "导入完成！\n";
            echo "成功: {$successCount} 条\n";
            echo "失败: {$errorCount} 条\n";
            echo str_repeat("=", 50) . "\n";

            return true;

        } catch (\Exception $e) {
            echo "\n执行过程中发生严重错误: " . $e->getMessage() . "\n";
            
            // 尝试恢复外键检查
            try {
                $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            } catch (\Exception $ex) {
                // 忽略
            }
            
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "开始回滚（清空测试数据）...\n";

        $db = $this->db;

        try {
            // 禁用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
            echo "已禁用外键检查\n";

            // 要清空的表（按依赖关系排序）
            $tables = [
                'media',
                'guestbook', 
                'statistics',
                'hero_achievement',
                'battle_phase',
                'story',
                'timeline_event',
                'weapon',
                'memorial',
                'hero',
                'battle',
            ];

            foreach ($tables as $table) {
                try {
                    $fullTableName = '{{%' . $table . '}}';
                    $this->truncateTable($fullTableName);
                    echo "✓ 已清空表: {$table}\n";
                } catch (\Exception $e) {
                    echo "✗ 清空表 {$table} 失败: " . $e->getMessage() . "\n";
                }
            }

            // 启用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            echo "已启用外键检查\n";

            echo "\n测试数据清空完成！\n";
            return true;

        } catch (\Exception $e) {
            echo "回滚过程中发生错误: " . $e->getMessage() . "\n";
            
            // 尝试恢复外键检查
            try {
                $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            } catch (\Exception $ex) {
                // 忽略
            }
            
            return false;
        }
    }
}
