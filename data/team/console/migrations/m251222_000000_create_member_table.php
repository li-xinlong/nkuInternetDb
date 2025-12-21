<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%member}}`.
 * 对应 install.sql 中的 member 表结构。
 */
class m251222_000000_create_member_table extends Migration
{
    public function safeUp()
    {
        // 如果表已存在则跳过，方便反复执行迁移脚本
        if ($this->db->getTableSchema('{{%member}}', true) !== null) {
            echo "table member already exists, skip create.\n";
            return true;
        }

        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'verification_token' => $this->string()->defaultValue(null),
            'avatar' => $this->string()->comment('头像'),
            'nickname' => $this->string(50)->comment('昵称'),
        ]);

        // 唯一索引
        $this->createIndex('member_username', '{{%member}}', 'username', true);
        $this->createIndex('member_email', '{{%member}}', 'email', true);
        $this->createIndex('member_password_reset_token', '{{%member}}', 'password_reset_token', true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}


