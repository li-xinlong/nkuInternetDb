<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Hero extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hero}}';
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
            'general' => '将领',
            'soldier' => '士兵',
            'spy' => '特工',
            'civilian' => '平民'
        ];
        return $map[$this->category] ?? '未知';
    }

    public function getAge()
    {
        if ($this->birth_date && $this->death_date) {
            $birth = strtotime($this->birth_date);
            $death = strtotime($this->death_date);
            return floor(($death - $birth) / 31536000);
        }
        return null;
    }
}
