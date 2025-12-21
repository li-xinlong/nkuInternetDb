<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Story extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%story}}';
    }

    /**
     * 動態產生規則，僅對當前資料表中真實存在的欄位進行驗證，
     * 以避免不同環境資料庫結構不一致時出現 UnknownPropertyException。
     */
    public function rules()
    {
        // 取得目前表格欄位名稱
        $cols = array_keys(static::getTableSchema()->columns);

        // 需要必填的欄位（前端表單目前只用到這幾個）
        $required = array_intersect(['title', 'content'], $cols);

        // 可作為 string 驗證的欄位
        $string100 = array_intersect(['category', 'author', 'author_role', 'location', 'source'], $cols);
        $string200 = array_intersect(['title'], $cols);
        $string500 = array_intersect(['cover_image', 'audio_url', 'video_url'], $cols);

        $rules = [];
        if ($required) {
            $rules[] = [$required, 'required'];
        }
        if ($string200) {
            $rules[] = [$string200, 'string', 'max' => 200];
        }
        if ($string100) {
            $rules[] = [$string100, 'string', 'max' => 100];
        }
        if ($string500) {
            $rules[] = [$string500, 'string', 'max' => 500];
        }

        // 文字內容欄位（長 text）
        $longText = array_intersect(['summary', 'content'], $cols);
        if ($longText) {
            $rules[] = [$longText, 'string'];
        }

        // 日期欄位
        if (in_array('event_date', $cols, true)) {
            $rules[] = [['event_date'], 'safe'];
        }

        // 整數欄位
        $intCols = array_intersect(['related_hero_id', 'related_battle_id', 'is_verified', 'views', 'likes', 'status'], $cols);
        if ($intCols) {
            $rules[] = [$intCols, 'integer'];
        }

        return $rules;
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () { return time(); },
            ],
        ];
    }

    public function getLikeCount()
    {
        return Statistics::getLikeCount('story', $this->id);
    }

    public function getCategoryText()
    {
        $map = [
            'memoir' => '回憶錄',
            'legend' => '傳奇',
            'diary'  => '日記',
            'letter' => '家書',
        ];
        return $map[$this->category] ?? '故事';
    }
}
