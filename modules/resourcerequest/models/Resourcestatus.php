<?php

namespace app\modules\resourcerequest\models;

use Yii;

class Resourcestatus extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'resource_status';
    }

    public function rules()
    {
        return [
            [['name', 'hexcolor'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['hexcolor'], 'string', 'max' => 10]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'hexcolor' => 'Hexcolor',
        ];
    }

    public function getResourceRequests()
    {
        return $this->hasMany(ResourceRequest::className(), ['resource_status_id' => 'id']);
    }
}
