<?php

use yii\db\Migration;

class m251220_150000_seed_demo_data extends Migration
{
    public function safeUp()
    {
        // 假資料：昨日訪問量 1600
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->batchInsert('{{%statistics}}',
            ['stat_date','stat_type','model_type','model_id','count','extra_data','created_at'],
            [[ $yesterday,'visit','frontend',0,1600,null,time()-86400 ]]);

        // 今日留言 6 則
        $now = time();
        for ($i=1;$i<=6;$i++) {
            $this->insert('{{%guestbook}}', [
                'name' => '测试用户'.$i,
                'content' => '示例评论 '.$i,
                'is_public'=>1,
                'status'=>1,
                'created_at'=>$now - rand(0,3600),
            ]);
        }

        // 今日故事 4 篇
        for ($j=1;$j<=4;$j++) {
            $this->insert('{{%story}}', [
                'title' => '示例故事 '.$j,
                'category' => 'memoir',
                'content' => '这是一个示例故事内容'.$j,
                'status'=>1,
                'created_at'=>$now - rand(0,3600),
                'updated_at'=>$now - rand(0,3600),
            ]);
        }
    }

    public function safeDown()
    {
        echo "m251220_150000_seed_demo_data cannot be reverted.\n";
        return false;
    }
}


