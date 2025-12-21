<?php

use yii\db\Migration;


class m251220_120000_remove_event_date_location_from_story_table extends Migration
{
    private const TABLE = '{{%story}}';

    public function safeUp(): bool
    {
        $schema = $this->db->schema->getTableSchema(self::TABLE, true);
        if ($schema === null) {
            echo "表 story 不存在，跳过。\n";
            return true;
        }

        if ($schema->getColumn('event_date') !== null) {
            $this->dropColumn(self::TABLE, 'event_date');
            echo "已刪除列 event_date\n";
        }
        if ($schema->getColumn('location') !== null) {
            $this->dropColumn(self::TABLE, 'location');
            echo "已刪除列 location\n";
        }
        return true;
    }

    public function safeDown(): bool
    {
        $schema = $this->db->schema->getTableSchema(self::TABLE, true);
        if ($schema === null) {
            echo "表 story 不存在，无需回滚。\n";
            return true;
        }

        if ($schema->getColumn('event_date') === null) {
            $this->addColumn(self::TABLE, 'event_date', $this->date()->comment('事件日期'));
            echo "已恢复列 event_date\n";
        }
        if ($schema->getColumn('location') === null) {
            $this->addColumn(self::TABLE, 'location', $this->string(200)->comment('事件地点'));
            echo "已恢复列 location\n";
        }
        return true;
    }
}

use yii\db\Migration;


class m251220_120000_remove_event_date_location_from_story_table extends Migration
{
    private const TABLE = '{{%story}}';

    public function safeUp(): bool
    {
        $schema = $this->db->schema->getTableSchema(self::TABLE, true);
        if ($schema === null) {
            echo "表 story 不存在，跳过。\n";
            return true;
        }

        if ($schema->getColumn('event_date') !== null) {
            $this->dropColumn(self::TABLE, 'event_date');
            echo "已刪除列 event_date\n";
        }
        if ($schema->getColumn('location') !== null) {
            $this->dropColumn(self::TABLE, 'location');
            echo "已刪除列 location\n";
        }
        return true;
    }

    public function safeDown(): bool
    {
        $schema = $this->db->schema->getTableSchema(self::TABLE, true);
        if ($schema === null) {
            echo "表 story 不存在，无需回滚。\n";
            return true;
        }

        if ($schema->getColumn('event_date') === null) {
            $this->addColumn(self::TABLE, 'event_date', $this->date()->comment('事件日期'));
            echo "已恢复列 event_date\n";
        }
        if ($schema->getColumn('location') === null) {
            $this->addColumn(self::TABLE, 'location', $this->string(200)->comment('事件地点'));
            echo "已恢复列 location\n";
        }
        return true;
    }
}