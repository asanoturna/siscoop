<?php
namespace app\modules\administrator\models;

use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $role_id;
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $status;
    public $phone;
    public $celphone;
    public $birthdate;
    public $location_id;
    public $department_id;
    public $file;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'fullname', 'status', 'phone', 'birthdate', 'location_id', 'department_id','role_id'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Usuário já existe!'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Endereço de e-mail já existe!'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Perfil de Acesso',
            'username' => 'Usuário',
            'auth_key' => 'Chave de Autenticação',
            'password' => 'Senha',
            'password_hash' => 'Senha',
            'password_reset_token' => 'Password Reset Token',
            'updated_at' => 'Alterado em',
            'created_at' => 'Criado em',
            'status' => 'Situação',
            'email' => 'Email',
            'avatar' => 'Imagem',
            'fullname' => 'Nome Completo',
            'phone' => 'Telefone / Ramal',
            'celphone' => 'Celular',
            'birthdate' => 'Data de Nascimento',
            'location_id' => 'Unidade',
            'department_id' => 'Departamento',
            'file' => 'Imagem',
        ];
    }    

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->role_id = $this->role_id;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->fullname = $this->fullname;
        $user->status = $this->status;
        $user->location_id = $this->location_id;
        $user->department_id = $this->department_id;
        $user->phone = $this->phone;
        $user->celphone = $this->celphone;
        $user->birthdate = $this->birthdate;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    } 
}