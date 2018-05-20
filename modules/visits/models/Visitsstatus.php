<?php

namespace app\modules\visits\models;

use Yii;

class Visitsstatus extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'visits_status';
    }

    public function rules()
    {
        return [
            [['name', 'hexcolor', 'about'], 'required'],
            [['name', 'hexcolor'], 'string', 'max' => 45],
            [['about'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Situação',
            'hexcolor' => 'Cor',
            'about' => 'Sobre a Situação',
        ];
    }

    public function getBusinessVisits()
    {
        return $this->hasMany(BusinessVisits::className(), ['visits_status_id' => 'id']);
    }
}