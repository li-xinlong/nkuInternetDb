<?php
namespace app\models;

use yii\db\ActiveRecord;

class HeroAchievement extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hero_achievement}}';
    }
}
