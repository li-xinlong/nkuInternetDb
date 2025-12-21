<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * ContactMessage 模型
 *
 * @property int $id
 * @property int $user_id 留言者（member 表 id）
 * @property string $body 留言内容
 * @property string|null $reply 管理员回复
 * @property int $status 0 未回复 1 已回复
 * @property int $created_at
 * @property int|null $replied_at
 *
 * @property Member $member
 */
class ContactMessage extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_REPLIED = 1;

    public static function tableName()
    {
        return '{{%contact_message}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class => [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'body'], 'required'],
            [['user_id', 'status', 'created_at', 'replied_at'], 'integer'],
            [['body', 'reply'], 'string'],
            ['status', 'default', 'value' => self::STATUS_PENDING],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'user_id'    => '用户',
            'body'       => '留言内容',
            'reply'      => '管理员回复',
            'status'     => '状态',
            'created_at' => '留言时间',
            'replied_at' => '回复时间',
        ];
    }

    /**
     * 关联前台会员表
     */
    public function getMember()
    {
        return $this->hasOne(Member::class, ['id' => 'user_id']);
    }

    /**
     * 兼容旧调用，返回 member
     */
    public function getUser()
    {
        return $this->getMember();
    }
}
