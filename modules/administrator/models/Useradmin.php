<?php

namespace app\modules\administrator\models;

use Yii;

use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Useradmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public $image;
    public $crop_info;    

    public function rules()
    {
        return [
            [['username', 'fullname', 'updated_at', 'created_at', 'email', 'birthdate', 'location_id', 'department_id', 'role_id', 'status'], 'required'],
            [['updated_at', 'created_at', 'status', 'location_id', 'department_id', 'role_id'], 'integer'],
            [['birthdate'], 'safe'],
            [['username', 'email', 'fullname'], 'string', 'max' => 255],
            [['avatar', 'phone', 'celphone'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [
                'image', 
                'file', 
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['crop_info', 'safe'],            
        ];
    }  

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Perfil de Acesso',
            'username' => 'Usuário',
            'auth_key' => 'Chave de Autenticação',
            'password_hash' => 'Senha',
            'password_reset_token' => 'Password Reset Token',
            'updated_at' => 'Alterado em',
            'created_at' => 'Criado em',
            'status' => 'Situação',
            'email' => 'Email',
            'avatar' => 'Imagem',
            'image' => 'Imagem',
            'fullname' => 'Nome Completo',
            'phone' => 'Telefone / Ramal',
            'celphone' => 'Celular',
            'birthdate' => 'Data de Nascimento',
            'location_id' => 'Unidade',
            'department_id' => 'Departamento',
        ];
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }      

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }  
}
