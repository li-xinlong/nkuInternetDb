<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Memorial extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%memorial}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getTypeText()
    {
        $map = [
            'museum' => '纪念馆',
            'monument' => '纪念碑',
            'site' => '遗址',
            'cemetery' => '烈士陵园'
        ];
        return $map[$this->type] ?? '未知';
    }
}
