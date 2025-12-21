<?php

use yii\db\Migration;

/**
 * Class m251220_130000_create_contact_message_table
 * 建立 contact_message 表，用於儲存前台會員留言與後台回覆。
 * 加入存在性檢查，避免重複創建導致遷移中斷。
 */
class m251220_130000_create_contact_message_table extends Migration
{
    private const TABLE = '{{%contact_message}}';

    public function safeUp(): bool
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            echo "表 contact_message 已存在，跳過建立。\n";
            return true;
        }

        $this->createTable(self::TABLE, [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull()->comment('留言者 ID'),
            'body'       => $this->text()->notNull()->comment('留言內容'),
            'reply'      => $this->text()->null()->comment('管理員回覆'),
            'status'     => $this->smallInteger()->notNull()->defaultValue(0)->comment('0 未回覆 1 已回覆'),
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
            echo "表 contact_message 不存在，無需回滚。\n";
            return true;
        }
        $this->dropForeignKey('fk-contact_message-user_id', self::TABLE);
        $this->dropIndex('idx-contact_message-user_id', self::TABLE);
        $this->dropTable(self::TABLE);
        return true;
    }
}
