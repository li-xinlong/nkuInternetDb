<?php

use yii\db\Migration;


class m251220_130000_create_contact_message_table extends Migration
{
    private const TABLE = '{{%contact_message}}';

    public function safeUp(): bool
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            echo "表 contact_message 已存在，跳过建立。\n";
            return true;
        }

        $this->createTable(self::TABLE, [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull()->comment('留言者 ID'),
            'body'       => $this->text()->notNull()->comment('留言內容'),
            'reply'      => $this->text()->null()->comment('管理员回复'),
            'status'     => $this->smallInteger()->notNull()->defaultValue(0)->comment('0 未回复 1 已回复'),
            'created_at' => $this->integer()->notNull(),
            'replied_at' => $this->integer()->null(),
        ]);

        $this->createIndex('idx-contact_message-user_id', self::TABLE, 'user_id');
        $this->addForeignKey('fk-contact_message-user_id', self::TABLE, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        return true;
    }

    public function safeDown(): bool
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            echo "表 contact_message 不存在，无需回滚。\n";
            return true;
        }
        $this->dropForeignKey('fk-contact_message-user_id', self::TABLE);
        $this->dropIndex('idx-contact_message-user_id', self::TABLE);
        $this->dropTable(self::TABLE);
        return true;
    }
}

use yii\db\Migration;


class m251220_130000_create_contact_message_table extends Migration
{
    private const TABLE = '{{%contact_message}}';

    public function safeUp(): bool
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            echo "表 contact_message 已存在，跳过建立。\n";
            return true;
        }

        $this->createTable(self::TABLE, [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull()->comment('留言者 ID'),
            'body'       => $this->text()->notNull()->comment('留言內容'),
            'reply'      => $this->text()->null()->comment('管理员回复'),
            'status'     => $this->smallInteger()->notNull()->defaultValue(0)->comment('0 未回复 1 已回复'),
            'created_at' => $this->integer()->notNull(),
            'replied_at' => $this->integer()->null(),
        ]);

        $this->createIndex('idx-contact_message-user_id', self::TABLE, 'user_id');
        $this->addForeignKey('fk-contact_message-user_id', self::TABLE, 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        return true;
    }

    public function safeDown(): bool
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            echo "表 contact_message 不存在，无需回滚。\n";
            return true;
        }
        $this->dropForeignKey('fk-contact_message-user_id', self::TABLE);
        $this->dropIndex('idx-contact_message-user_id', self::TABLE);
        $this->dropTable(self::TABLE);
        return true;
    }
}