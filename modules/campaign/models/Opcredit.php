<?php

namespace app\modules\campaign\models;
use app\models\User;
use app\models\Location;
use Yii;

class Opcredit extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'campaign_opcredit';
    }

    public function rules()
    {
        return [
            [['name', 'proposed', 'accomplished', 'location_id', 'user_id'], 'required'],
            [['proposed', 'accomplished'], 'number'],
            [['date1', 'date2', 'created', 'updated'], 'safe'],
            [['progress'], 'string'],
            [['location_id', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'proposed' => 'Proposto',
            'accomplished' => 'Realizado',
            'date1' => '1ª Abordagem',
            'date2' => '2ª Abordagem',
            'progress' => 'Andamento',
            'created' => 'Criado em',
            'updated' => 'Alterado em',
            'location_id' => 'PA',
            'user_id' => 'Gerente',
        ];
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }      
}