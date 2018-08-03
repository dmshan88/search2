<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use app\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $oldpassword;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        // if (empty($token) || !is_string($token)) {
        //     throw new InvalidParamException('Password reset token cannot be blank.');
        // }
        // $this->_user = User::findByPasswordResetToken($token);
        $this->_user = User::findIdentity(Yii::$app->user->id);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong id.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'oldpassword'], 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        if (!$user->validatePassword($this->oldpassword)) {
            return false;
        }
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
        public function attributeLabels()
    {
        return  [
                'password' => '新密码',
                'oldpassword' => '旧密码',
            ];
    }
}
