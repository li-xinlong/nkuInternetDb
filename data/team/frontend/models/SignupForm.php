<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Member;

/**
 * 前台會員註冊表單
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\\common\\models\\Member', 'message' => '該用戶名已被註冊。'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\\common\\models\\Member', 'message' => '該郵箱已被註冊。'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * 建立會員
     * @return Member|null
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $member = new Member();
        $member->username = $this->username;
        $member->email = $this->email;
        $member->setPassword($this->password);
        $member->generateAuthKey();
        // Member 默認狀態為 ACTIVE
        if ($member->save()) {
            return $member;
        }
        return null;
    }
}
