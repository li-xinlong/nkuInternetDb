<?php
use yii\db\Migration;

class m251220_150200_adjust_visit_stats extends Migration
{
    public function safeUp()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        // 清理旧的 demo 访问量
        $this->delete('{{%statistics}}',[ 'stat_type'=>'visit', 'stat_date'=>$today]);
        $this->delete('{{%statistics}}',[ 'stat_type'=>'visit', 'stat_date'=>$yesterday]);

        // 插入新的较小量级数据
        $now = time();
        $this->batchInsert('{{%statistics}}',
            ['stat_date','stat_type','model_type','model_id','count','extra_data','created_at'],
            [
                [$today,     'visit','frontend',0, 380, null, $now],
                [$yesterday, 'visit','frontend',0, 275, null, $now-86400],
            ]);
    }

    public function safeDown()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->delete('{{%statistics}}',[ 'stat_type'=>'visit', 'stat_date'=>[$today,$yesterday] ]);
        echo "Visit stats reset.\n";
        return true;
    }
}


