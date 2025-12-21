<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm 用于提交用户留言。
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // 仅留言内容必填
            ['body', 'required'],
            // 其他字段标记为安全属性，便于后续自动赋值
            [['name', 'email', 'subject'], 'safe'],
            // 邮箱格式校验（若有提供）
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'body'   => '留言内容',
        ];
    }

    /**
     * 发送邮件到指定地址。
     *
     * @param string $email 目标邮箱
     * @return bool 是否发送成功
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email ?: Yii::$app->user->identity->email => $this->name ?: Yii::$app->user->identity->username])
            ->setSubject($this->subject ?: '网站留言')
            ->setTextBody($this->body)
            ->send();
    }
}
