<?php

namespace app\modules\visits\models;

use Yii;

class Visitsfinality extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'visits_finality';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Finalidade',
        ];
    }

    public function getBusinessVisits()
    {
        return $this->hasMany(BusinessVisits::className(), ['visits_finality_id' => 'id']);
    }
}