<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sensitive_word}}`.
 * 加入存在性檢查，避免因表已存在而導致整批 migration 中斷。
 */
class m251220_110000_create_sensitive_word_table extends Migration
{
    private const TABLE_NAME = '{{%sensitive_word}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 若表已存在則直接標記成功，避免重複創建錯誤
        if ($this->db->schema->getTableSchema(self::TABLE_NAME, true) !== null) {
            \Yii::info('Table '.self::TABLE_NAME.' already exists, skip creation.', __METHOD__);
            return true;
        }

        $this->createTable(self::TABLE_NAME, [
            'id'         => $this->primaryKey(),
            'word'       => $this->string(100)->notNull()->unique()->comment('敏感詞'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // 為 word 欄位添加索引以提高查詢效率
        $this->createIndex(
            'idx-sensitive_word-word',
            self::TABLE_NAME,
            'word'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
