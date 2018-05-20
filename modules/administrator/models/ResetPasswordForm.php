<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
    public $confirmPassword;
    private $_user;

    public function __construct($user, $config = [])
    {
        $this->_user = $user;
        if (!$this->_user) {
            throw new InvalidConfigException('UserModel must be set.');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['password', 'confirmPassword'], 'filter', 'filter' => 'trim'],
            ['password', 'required'],
            ['confirmPassword', 'required'],
            [['password', 'confirmPassword'], 'string', 'min' => '3'],
            [['password', 'confirmPassword'], 'match', 'pattern' => '/^[a-z0-9]+$/i'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Nova Senha',
            'confirmPassword' => 'Confirmação da Senha',
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        if ($this->validate()) {
            $user->setPassword($this->password);
            return $user->save(true, ['password_hash']);
        } else {
            return false;
        }
    }
}
