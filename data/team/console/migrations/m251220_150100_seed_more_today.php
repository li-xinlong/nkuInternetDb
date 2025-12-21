<?php
use yii\db\Migration;

class m251220_150100_seed_more_today extends Migration
{
    public function safeUp()
    {
        $now = time();
        // 再新增 40 条评论
        for ($i=1;$i<=40;$i++) {
            $this->insert('{{%guestbook}}', [
                'name' => '演示用户'.($i+6),
                'content' => '自动生成评论 '.$i,
                'is_public'=>1,
                'status'=>1,
                'created_at'=>$now - rand(0, 3600),
            ]);
        }
        // 再新增 20 篇故事
        for ($j=1;$j<=20;$j++) {
            $this->insert('{{%story}}', [
                'title' => '自动生成故事 '.$j,
                'category' => 'memoir',
                'content' => '这是自动生成的示例故事内容'.$j,
                'status'=>1,
                'created_at'=>$now - rand(0, 3600),
                'updated_at'=>$now - rand(0, 3600),
            ]);
        }
    }

    public function safeDown()
    {
        // 不实现回滚
        return false;
    }
}

