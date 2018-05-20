<?php

namespace app\modules\administrator\models;

use Yii;
use app\models\User;

class Links extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'links';
    }

    public function rules()
    {
        return [
            [['name', 'url', 'created', 'updated', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['url','description'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'user_id' => 'Usuário',
            'description' => 'Descrição',
            'url' => 'Endereço',
            'created' => 'Criação',
            'updated' => 'Alteração',
            'status' => 'Situação',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }    
}