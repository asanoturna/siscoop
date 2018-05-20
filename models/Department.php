<?php

namespace app\models;

use Yii;

class Department extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'department';
    }

    public function rules()
    {
        return [
            [['name', 'description', 'email', 'is_active'], 'required'],
            [['description','hexcolor'], 'string'],
            ['email', 'email'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Departamento',
            'description' => 'Descrição',
            'email' => 'E-mail',
            'hexcolor' => 'Cor',
            'is_active' => 'Situação',
        ];
    }
}
