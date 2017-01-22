<?php

namespace app\modules\administrator\models;

use Yii;

class Role extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'role';
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            ['email', 'email'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Perfil de Acesso',
            'description' => 'Descrição do Perfil',
        ];
    }
}
