<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Statistics model
 *
 * @property integer $id
 * @property string $stat_date
 * @property string $stat_type
 * @property string $model_type
 * @property integer $model_id
 * @property integer $count
 * @property string $extra_data
 * @property integer $created_at
 */
class Statistics extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%statistics}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stat_date', 'stat_type', 'count', 'created_at'], 'required'],
            [['stat_date'], 'safe'],
            [['model_id', 'count', 'created_at'], 'integer'],
            [['extra_data'], 'string'],
            [['stat_type', 'model_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stat_date' => '统计日期',
            'stat_type' => '统计类型',
            'model_type' => '模型类型',
            'model_id' => '模型ID',
            'count' => '计数',
            'extra_data' => '额外数据',
            'created_at' => '创建时间',
        ];
    }

    /**
     * 获取当天的访问量总数
     * @param string|null $date 日期，默认为今天
     * @return int
     */
    public static function getTodayVisitCount($date = null)
    {
        if ($date === null) {
            $date = date('Y-m-d');
        }

        return static::find()
            ->where(['stat_date' => $date, 'stat_type' => 'visit'])
            ->sum('count') ?: 0;
    }

    /**
     * 获取指定日期范围的访问量
     * @param string $startDate 开始日期
     * @param string $endDate 结束日期
     * @return int
     */
    public static function getVisitCountByDateRange($startDate, $endDate)
    {
        return static::find()
            ->where(['stat_type' => 'visit'])
            ->andWhere(['>=', 'stat_date', $startDate])
            ->andWhere(['<=', 'stat_date', $endDate])
            ->sum('count') ?: 0;
    }

    /**
     * 记录访问量
     * @param string $modelType 模型类型
     * @param int $modelId 模型ID
     * @param int $count 访问次数，默认为1
     * @return bool
     */
    public static function recordVisit($modelType, $modelId, $count = 1)
    {
        return static::recordStat('visit', $modelType, $modelId, $count);
    }

    /**
     * 记录点赞等其他统计
     *
     * @param string $statType 统计类型，如 like
     * @param string $modelType 模型类型
     * @param int $modelId 模型ID
     * @param int $count 次数
     * @return bool
     */
    public static function recordStat($statType, $modelType, $modelId, $count = 1)
    {
        $date = date('Y-m-d');
        $stat = static::findOne([
            'stat_date' => $date,
            'stat_type' => $statType,
            'model_type' => $modelType,
            'model_id' => $modelId,
        ]);

        if ($stat) {
            $stat->count += $count;
            return $stat->save(false);
        } else {
            $stat = new static();
            $stat->stat_date = $date;
            $stat->stat_type = $statType;
            $stat->model_type = $modelType;
            $stat->model_id = $modelId;
            $stat->count = $count;
            $stat->created_at = time();
            return $stat->save(false);
        }
    }

    /**
     * 记录点赞
     */
    public static function recordLike($modelType, $modelId, $count = 1)
    {
        return static::recordStat('like', $modelType, $modelId, $count);
    }

    /**
     * 获取某个对象的点赞数量
     */
    public static function getLikeCount($modelType, $modelId): int
    {
        return static::find()
            ->where([
                'stat_type' => 'like',
                'model_type' => $modelType,
                'model_id' => $modelId,
            ])
            ->sum('count') ?: 0;
    }
}


