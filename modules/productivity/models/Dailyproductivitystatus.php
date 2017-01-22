<?php

namespace app\modules\productivity\models;
use app\models\User;
use app\models\Location;

use Yii;

class Dailyproductivitystatus extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'daily_productivity_status';
    }

    public function rules()
    {
        return [
            [['name', 'desc'], 'required'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 100]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'is_active' => 'Is Active',
        ];
    }
}
