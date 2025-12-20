<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Weapon extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%weapon}}';
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
            'rifle' => '步枪',
            'machinegun' => '机枪',
            'artillery' => '火炮',
            'tank' => '坦克',
            'aircraft' => '飞机',
            'ship' => '舰船'
        ];
        return $map[$this->category] ?? '武器';
    }
}
