<?php

use yii\db\Migration;

class example_create_new_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 检查表是否已存在，如果存在则跳过
        $checkTable = function($tableName) {
            $rawName = $this->db->schema->getRawTableName($tableName);
            return $this->db->getTableSchema($rawName, true) !== null;
        };
        
        // 创建你的新表
        if ($checkTable('{{%your_table_name}}')) {
            echo "表 your_table_name 已存在，跳过创建\n";
        } else {
            $this->createTable('{{%your_table_name}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(100)->notNull()->comment('名称'),
                'description' => $this->text()->comment('描述'),
                'status' => $this->tinyInteger()->defaultValue(1)->comment('状态'),
                'sort_order' => $this->integer()->defaultValue(0)->comment('排序'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ]);
            
            // 创建索引
            $this->createIndex('idx-your_table_name-name', '{{%your_table_name}}', 'name');
            $this->createIndex('idx-your_table_name-status', '{{%your_table_name}}', 'status');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%your_table_name}}');
    }
}
