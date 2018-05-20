<?php

namespace app\modules\task\models;

use Yii;

class Status extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mod_task_status';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Situação',
        ];
    }

    public function getModTaskLists()
    {
        return $this->hasMany(ModTaskList::className(), ['status_id' => 'id']);
    }
}
