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

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['duration_days', 'troops_cn', 'troops_jp', 'casualties_cn', 'casualties_jp', 'importance_level', 'views', 'status'], 'integer'],
            [['significance', 'description'], 'string'],
            [['name', 'english_name'], 'string', 'max' => 100],
            [['location', 'commander_cn', 'commander_jp'], 'string', 'max' => 200],
            [['result'], 'string', 'max' => 50],
            ['status', 'default', 'value' => 1],
            ['status', 'in', 'range' => [0, 1]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '战役名称',
            'english_name' => '英文名称',
            'location' => '战役地点',
            'latitude' => '纬度',
            'longitude' => '经度',
            'start_date' => '开始日期',
            'end_date' => '结束日期',
            'duration_days' => '持续天数',
            'commander_cn' => '中方指挥官',
            'commander_jp' => '日方指挥官',
            'troops_cn' => '中方兵力',
            'troops_jp' => '日方兵力',
            'casualties_cn' => '中方伤亡',
            'casualties_jp' => '日方伤亡',
            'result' => '战役结果',
            'significance' => '历史意义',
            'description' => '战役描述',
            'importance_level' => '重要程度',
            'views' => '浏览量',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
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
