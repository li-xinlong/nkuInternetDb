<?php

use yii\db\Migration;

/**
 * Class m251220_031659_create_war_memorial_tables
 */
class m251220_031659_create_war_memorial_tables extends Migration
{
    public function safeUp()
    {
        // 1. 战役表
        $this->createTable('{{%battle}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('战役名称'),
            'english_name' => $this->string(100)->comment('英文名称'),
            'location' => $this->string(200)->comment('战役地点'),
            'latitude' => $this->decimal(10, 7)->comment('纬度'),
            'longitude' => $this->decimal(10, 7)->comment('经度'),
            'start_date' => $this->date()->comment('开始日期'),
            'end_date' => $this->date()->comment('结束日期'),
            'duration_days' => $this->integer()->comment('持续天数'),
            'commander_cn' => $this->string(200)->comment('中方指挥官'),
            'commander_jp' => $this->string(200)->comment('日方指挥官'),
            'troops_cn' => $this->integer()->comment('中方兵力'),
            'troops_jp' => $this->integer()->comment('日方兵力'),
            'casualties_cn' => $this->integer()->comment('中方伤亡'),
            'casualties_jp' => $this->integer()->comment('日方伤亡'),
            'result' => $this->string(50)->comment('战役结果:victory胜利/defeat失败/stalemate僵持'),
            'significance' => $this->text()->comment('历史意义'),
            'description' => $this->text()->comment('战役描述'),
            'cover_image' => $this->string(255)->comment('封面图'),
            'battle_map' => $this->string(255)->comment('战役地图'),
            'importance_level' => $this->tinyInteger()->defaultValue(3)->comment('重要程度:1-5'),
            'views' => $this->integer()->defaultValue(0)->comment('浏览量'),
            'status' => $this->tinyInteger()->defaultValue(1)->comment('状态'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-battle-start_date', '{{%battle}}', 'start_date');
        $this->createIndex('idx-battle-result', '{{%battle}}', 'result');

        // 2. 战役阶段表
        $this->createTable('{{%battle_phase}}', [
            'id' => $this->primaryKey(),
            'battle_id' => $this->integer()->notNull()->comment('战役ID'),
            'phase_name' => $this->string(100)->notNull()->comment('阶段名称'),
            'phase_order' => $this->integer()->comment('阶段顺序'),
            'start_date' => $this->date()->comment('开始日期'),
            'end_date' => $this->date()->comment('结束日期'),
            'description' => $this->text()->comment('阶段描述'),
            'key_events' => $this->text()->comment('关键事件'),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-battle_phase-battle_id', '{{%battle_phase}}', 'battle_id');

        // 3. 英雄人物表
        $this->createTable('{{%hero}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('姓名'),
            'alias' => $this->string(50)->comment('别名/字号'),
            'gender' => $this->tinyInteger()->comment('性别:1男2女'),
            'birth_date' => $this->date()->comment('出生日期'),
            'death_date' => $this->date()->comment('牺牲日期'),
            'birthplace' => $this->string(100)->comment('籍贯'),
            'rank' => $this->string(50)->comment('军衔'),
            'unit' => $this->string(100)->comment('所属部队'),
            'category' => $this->string(50)->comment('类别:general将领/soldier士兵/spy特工/civilian平民'),
            'photo' => $this->string(255)->comment('照片'),
            'biography' => $this->text()->comment('人物传记'),
            'major_battles' => $this->text()->comment('参与战役'),
            'honors' => $this->text()->comment('荣誉勋章'),
            'famous_quotes' => $this->text()->comment('名言'),
            'sacrifice_location' => $this->string(200)->comment('牺牲地点'),
            'memorial_location' => $this->string(200)->comment('纪念地'),
            'views' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-hero-category', '{{%hero}}', 'category');

        // 4. 英雄事迹表
        $this->createTable('{{%hero_achievement}}', [
            'id' => $this->primaryKey(),
            'hero_id' => $this->integer()->notNull()->comment('英雄ID'),
            'title' => $this->string(200)->notNull()->comment('事迹标题'),
            'event_date' => $this->date()->comment('事件日期'),
            'location' => $this->string(200)->comment('事件地点'),
            'description' => $this->text()->comment('详细描述'),
            'impact' => $this->text()->comment('影响意义'),
            'images' => $this->text()->comment('相关图片JSON'),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-hero_achievement-hero_id', '{{%hero_achievement}}', 'hero_id');

        // 5. 武器装备表
        $this->createTable('{{%weapon}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('武器名称'),
            'model' => $this->string(50)->comment('型号'),
            'country' => $this->string(50)->comment('生产国:中国/苏联/美国/德国/日本等'),
            'category' => $this->string(50)->comment('类别:rifle步枪/machinegun机枪/artillery火炮/tank坦克/aircraft飞机/ship舰船'),
            'caliber' => $this->string(50)->comment('口径'),
            'weight' => $this->decimal(10, 2)->comment('重量(kg)'),
            'range' => $this->integer()->comment('射程(m)'),
            'rate_of_fire' => $this->integer()->comment('射速(发/分)'),
            'production_year' => $this->integer()->comment('生产年份'),
            'quantity_used' => $this->integer()->comment('使用数量'),
            'description' => $this->text()->comment('武器描述'),
            'technical_specs' => $this->text()->comment('技术参数JSON'),
            'famous_battles' => $this->text()->comment('著名战役'),
            'image' => $this->string(255)->comment('武器图片'),
            'blueprint' => $this->string(255)->comment('设计图纸'),
            'views' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-weapon-category', '{{%weapon}}', 'category');
        $this->createIndex('idx-weapon-country', '{{%weapon}}', 'country');

        // 6. 历史时间轴表
        $this->createTable('{{%timeline_event}}', [
            'id' => $this->primaryKey(),
            'event_date' => $this->date()->notNull()->comment('事件日期'),
            'title' => $this->string(200)->notNull()->comment('事件标题'),
            'category' => $this->string(50)->comment('类别:battle战役/politics政治/diplomacy外交/massacre屠杀/victory胜利'),
            'location' => $this->string(200)->comment('事件地点'),
            'description' => $this->text()->comment('事件描述'),
            'participants' => $this->string(500)->comment('参与人物'),
            'impact' => $this->text()->comment('历史影响'),
            'related_battle_id' => $this->integer()->comment('关联战役ID'),
            'related_hero_id' => $this->integer()->comment('关联英雄ID'),
            'image' => $this->string(255)->comment('事件图片'),
            'importance_level' => $this->tinyInteger()->defaultValue(3)->comment('重要程度:1-5'),
            'views' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-timeline_event-event_date', '{{%timeline_event}}', 'event_date');
        $this->createIndex('idx-timeline_event-category', '{{%timeline_event}}', 'category');

        // 7. 纪念馆/遗址表
        $this->createTable('{{%memorial}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull()->comment('纪念馆名称'),
            'type' => $this->string(50)->comment('类型:museum纪念馆/monument纪念碑/site遗址/cemetery烈士陵园'),
            'province' => $this->string(50)->comment('省份'),
            'city' => $this->string(50)->comment('城市'),
            'address' => $this->string(300)->comment('详细地址'),
            'latitude' => $this->decimal(10, 7)->comment('纬度'),
            'longitude' => $this->decimal(10, 7)->comment('经度'),
            'established_date' => $this->date()->comment('建立日期'),
            'area' => $this->decimal(10, 2)->comment('占地面积(平方米)'),
            'description' => $this->text()->comment('简介'),
            'collections' => $this->text()->comment('馆藏文物'),
            'opening_hours' => $this->string(200)->comment('开放时间'),
            'ticket_price' => $this->decimal(10, 2)->comment('门票价格'),
            'contact_phone' => $this->string(50)->comment('联系电话'),
            'website' => $this->string(200)->comment('官方网站'),
            'cover_image' => $this->string(255)->comment('封面图'),
            'gallery_images' => $this->text()->comment('相册图片JSON'),
            'views' => $this->integer()->defaultValue(0),
            'rating' => $this->decimal(3, 1)->defaultValue(0)->comment('评分'),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-memorial-type', '{{%memorial}}', 'type');
        $this->createIndex('idx-memorial-province', '{{%memorial}}', 'province');

        // 8. 抗战故事表
        $this->createTable('{{%story}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull()->comment('故事标题'),
            'category' => $this->string(50)->comment('类别:memoir回忆录/legend传奇/diary日记/letter家书'),
            'author' => $this->string(100)->comment('作者/讲述人'),
            'author_role' => $this->string(100)->comment('作者身份'),
            'event_date' => $this->date()->comment('事件日期'),
            'location' => $this->string(200)->comment('事件地点'),
            'summary' => $this->text()->comment('摘要'),
            'content' => $this->text()->comment('故事内容'),
            'related_hero_id' => $this->integer()->comment('关联英雄ID'),
            'related_battle_id' => $this->integer()->comment('关联战役ID'),
            'source' => $this->string(200)->comment('来源'),
            'cover_image' => $this->string(255)->comment('封面图'),
            'audio_url' => $this->string(500)->comment('音频链接'),
            'video_url' => $this->string(500)->comment('视频链接'),
            'is_verified' => $this->tinyInteger()->defaultValue(0)->comment('是否已验证'),
            'views' => $this->integer()->defaultValue(0),
            'likes' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-story-category', '{{%story}}', 'category');

        // 9. 多媒体资源表
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull()->comment('标题'),
            'type' => $this->string(20)->notNull()->comment('类型:image图片/video视频/audio音频/document文档'),
            'category' => $this->string(50)->comment('分类:photo照片/poster海报/map地图/film影片/song歌曲'),
            'file_path' => $this->string(500)->comment('文件路径'),
            'file_url' => $this->string(500)->comment('外部链接'),
            'file_size' => $this->integer()->comment('文件大小(字节)'),
            'duration' => $this->integer()->comment('时长(秒)'),
            'description' => $this->text()->comment('描述'),
            'source' => $this->string(200)->comment('来源'),
            'date_taken' => $this->date()->comment('拍摄/创作日期'),
            'photographer' => $this->string(100)->comment('摄影师/创作者'),
            'location' => $this->string(200)->comment('拍摄地点'),
            'related_model' => $this->string(50)->comment('关联模型:battle/hero/memorial'),
            'related_id' => $this->integer()->comment('关联ID'),
            'views' => $this->integer()->defaultValue(0),
            'downloads' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-media-type', '{{%media}}', 'type');
        $this->createIndex('idx-media-related', '{{%media}}', ['related_model', 'related_id']);

        // 10. 留言板表
        $this->createTable('{{%guestbook}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('留言者姓名'),
            'email' => $this->string(100)->comment('邮箱'),
            'content' => $this->text()->notNull()->comment('留言内容'),
            'category' => $this->string(50)->comment('类别:tribute缅怀/comment评论/suggestion建议'),
            'related_model' => $this->string(50)->comment('关联模型'),
            'related_id' => $this->integer()->comment('关联ID'),
            'reply' => $this->text()->comment('回复内容'),
            'ip' => $this->string(50)->comment('IP地址'),
            'is_public' => $this->tinyInteger()->defaultValue(1)->comment('是否公开'),
            'status' => $this->tinyInteger()->defaultValue(0)->comment('状态:0待审核1已审核2已回复'),
            'replied_at' => $this->integer()->comment('回复时间'),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-guestbook-status', '{{%guestbook}}', 'status');

        // 11. 统计数据表
        $this->createTable('{{%statistics}}', [
            'id' => $this->primaryKey(),
            'stat_date' => $this->date()->notNull()->comment('统计日期'),
            'stat_type' => $this->string(50)->notNull()->comment('类型:visit访问/search搜索/popular热门'),
            'model_type' => $this->string(50)->comment('模型类型:battle/hero/weapon等'),
            'model_id' => $this->integer()->comment('模型ID'),
            'count' => $this->integer()->defaultValue(0)->comment('计数'),
            'extra_data' => $this->text()->comment('额外数据JSON'),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-statistics-date', '{{%statistics}}', 'stat_date');
        $this->createIndex('idx-statistics-type', '{{%statistics}}', ['stat_type', 'model_type']);

        // 12. 用户扩展(添加字段到已有user表)
        $this->addColumn('{{%user}}', 'avatar', $this->string(255)->comment('头像'));
        $this->addColumn('{{%user}}', 'nickname', $this->string(50)->comment('昵称'));
        $this->addColumn('{{%user}}', 'role', $this->string(20)->defaultValue('user')->comment('角色:admin/editor/user'));
    }

    public function safeDown()
    {
        $this->dropTable('{{%statistics}}');
        $this->dropTable('{{%guestbook}}');
        $this->dropTable('{{%media}}');
        $this->dropTable('{{%story}}');
        $this->dropTable('{{%memorial}}');
        $this->dropTable('{{%timeline_event}}');
        $this->dropTable('{{%weapon}}');
        $this->dropTable('{{%hero_achievement}}');
        $this->dropTable('{{%hero}}');
        $this->dropTable('{{%battle_phase}}');
        $this->dropTable('{{%battle}}');
        
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'nickname');
        $this->dropColumn('{{%user}}', 'role');
    }
}