<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function up()
    {
        $tableName = $this->db->schema->getRawTableName('{{%user}}');
        $table = $this->db->getTableSchema($tableName, true);
        if ($table === null) {
            echo "表 {$tableName} 不存在，跳过添加字段\n";
            return;
        }
        
        if (isset($table->columns['verification_token'])) {
            echo "字段 verification_token 已存在，跳过添加\n";
            return;
        }
        
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
