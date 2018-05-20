<?php

namespace app\models;

use Yii;

class Person extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'person';
    }

    public function rules()
    {
        return [
            [['name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tipo',
            'is_active' => 'Ativo',
        ];
    }

    public function getDailyProductivities()
    {
        return $this->hasMany(DailyProductivity::className(), ['person_id' => 'id']);
    }
}
