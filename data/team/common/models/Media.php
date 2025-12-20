<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Media extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%media}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
