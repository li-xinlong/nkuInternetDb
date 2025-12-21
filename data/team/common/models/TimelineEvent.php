<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class TimelineEvent extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%timeline_event}}';
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
            'battle' => '战役',
            'politics' => '政治',
            'diplomacy' => '外交',
            'massacre' => '屠杀',
            'victory' => '胜利'
        ];
        return $map[$this->category] ?? '事件';
    }
}
