<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Guestbook model
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $content
 * @property string|null $category
 * @property string|null $related_model
 * @property int|null $related_id
 * @property string|null $reply
 * @property string|null $ip
 * @property int $is_public
 * @property int $status
 * @property int|null $replied_at
 * @property int $created_at
 *
 * @property-read int $likeCount
 */
class Guestbook extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['content', 'reply'], 'string'],
            [['related_id', 'is_public', 'status', 'replied_at', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['category', 'related_model', 'ip'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '昵称',
            'email' => '邮箱',
            'content' => '留言内容',
            'category' => '类别',
            'related_model' => '关联模型',
            'related_id' => '关联ID',
            'reply' => '回复内容',
            'ip' => 'IP 地址',
            'is_public' => '是否公开',
            'status' => '状态',
            'replied_at' => '回复时间',
            'created_at' => '创建时间',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            if ($this->category === null) {
                $this->category = 'comment';
            }
            if ($this->is_public === null) {
                $this->is_public = 1;
            }
            if ($this->status === null) {
                // 新留言默认为待审核
                $this->status = 0;
            }
            if ($this->created_at === null) {
                $this->created_at = time();
            }
            if ($this->ip === null) {
                $this->ip = Yii::$app->request->userIP;
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * 当前留言的点赞数量
     */
    public function getLikeCount(): int
    {
        return Statistics::getLikeCount('guestbook', $this->id);
    }
}


