<?php
namespace app\models;

use yii\db\ActiveRecord;

class BattlePhase extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%battle_phase}}';
    }
}
