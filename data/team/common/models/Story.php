<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Story extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%story}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getCategoryText()
    {
        $map = [
            'memoir' => '回忆录',
            'legend' => '传奇',
            'diary' => '日记',
            'letter' => '家书'
        ];
        return $map[$this->category] ?? '故事';
    }
}
