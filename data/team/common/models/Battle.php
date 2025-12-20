<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Battle extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%battle}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getResultText()
    {
        $map = [
            'victory' => '胜利',
            'defeat' => '失败',
            'stalemate' => '僵持'
        ];
        return $map[$this->result] ?? '未知';
    }

    public function getResultClass()
    {
        $map = [
            'victory' => 'success',
            'defeat' => 'danger',
            'stalemate' => 'warning'
        ];
        return $map[$this->result] ?? 'default';
    }
}
