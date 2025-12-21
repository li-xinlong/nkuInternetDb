<?php

use yii\db\Migration;

class m251220_140000_drop_fk_contact_message extends Migration
{
    public function safeUp()
    {
        $table = '{{%contact_message}}';
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
  
        try {
            $this->dropForeignKey('fk-contact_message-user_id', $table);
        } catch (\Exception $e) {
            // ignore
        }
        $this->execute("SET FOREIGN_KEY_CHECKS=1;");
    }

    public function safeDown()
    {
        
        echo "m251220_140000_drop_fk_contact_message cannot be reverted.\n";
        return false;
    }
}



