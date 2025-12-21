<?php

use yii\db\Migration;

class m251220_140000_drop_fk_contact_message extends Migration
{
    public function safeUp()
    {
        // 若外鍵存在則刪除
        $table = '{{%contact_message}}';
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        // 捕捉異常避免外鍵不存在時報錯
        try {
            $this->dropForeignKey('fk-contact_message-user_id', $table);
        } catch (\Exception $e) {
            // ignore
        }
        $this->execute("SET FOREIGN_KEY_CHECKS=1;");
    }

    public function safeDown()
    {
        // 不回復外鍵，以避免再次觸發 bug
        echo "m251220_140000_drop_fk_contact_message cannot be reverted.\n";
        return false;
    }
}


