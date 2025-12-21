<?php

use yii\db\Migration;

/**
 * 示例：插入数据的迁移文件模板
 * 
 * 使用方法：
 * 1. 使用命令生成：php yii migrate/create insert_your_data_name
 * 2. 或者复制此文件，重命名为：m日期时间_insert_your_data_name.php
 * 3. 修改类名
 * 4. 在 safeUp() 中插入数据
 * 5. 在 safeDown() 中删除数据（回滚）
 */
class example_insert_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        echo "开始导入数据...\n";

        // 方式1：从SQL文件导入（推荐，适合大量数据）
        $sqlFile = __DIR__ . '/your_data.sql';
        
        if (file_exists($sqlFile)) {
            echo "找到SQL文件: {$sqlFile}\n";
            echo "开始读取文件...\n";

            $content = file_get_contents($sqlFile);
            
            if ($content === false) {
                echo "错误: 无法读取SQL文件\n";
                return false;
            }

            echo "文件大小: " . strlen($content) . " 字节\n";

            $db = $this->db;
            
            try {
                // 禁用外键检查
                $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
                echo "已禁用外键检查\n";

                // 清理SQL内容
                $content = preg_replace('/--[^\n]*\n/', "\n", $content);
                $content = preg_replace('/\/\*.*?\*\//s', '', $content);
                
                // 分割SQL语句
                $statements = explode(';', $content);
                $statements = array_filter(array_map('trim', $statements));
                
                echo "共有 " . count($statements) . " 条SQL语句\n";
                echo "开始执行...\n\n";

                $successCount = 0;
                $errorCount = 0;

                foreach ($statements as $index => $statement) {
                    if (empty($statement)) {
                        continue;
                    }

                    try {
                        $db->createCommand($statement)->execute();
                        $successCount++;
                        
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

            } catch (\Exception $e) {
                echo "\n执行过程中发生严重错误: " . $e->getMessage() . "\n";
                
                try {
                    $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
                } catch (\Exception $ex) {
                    // 忽略
                }
                
                return false;
            }
        } else {
            // 方式2：直接插入数据（适合少量数据）
            echo "SQL文件不存在，使用直接插入方式\n";
            
            $this->insert('{{%your_table_name}}', [
                'name' => '示例数据1',
                'description' => '这是第一条示例数据',
                'status' => 1,
                'sort_order' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ]);

            // 批量插入
            $this->batchInsert('{{%your_table_name}}', 
                ['name', 'description', 'status', 'sort_order', 'created_at', 'updated_at'],
                [
                    ['示例数据2', '这是第二条示例数据', 1, 2, time(), time()],
                    ['示例数据3', '这是第三条示例数据', 1, 3, time(), time()],
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "开始回滚（清空数据）...\n";

        $db = $this->db;

        try {
            // 禁用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
            echo "已禁用外键检查\n";

            // 清空表（保留表结构）
            $this->truncateTable('{{%your_table_name}}');
            echo "✓ 已清空表: your_table_name\n";

            // 启用外键检查
            $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            echo "已启用外键检查\n";

            echo "\n数据清空完成！\n";
            return true;

        } catch (\Exception $e) {
            echo "回滚过程中发生错误: " . $e->getMessage() . "\n";
            
            try {
                $db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
            } catch (\Exception $ex) {
                // 忽略
            }
            
            return false;
        }
    }
}
