<?php

namespace app\modules\task\models;

use Yii;

class Priority extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mod_task_priority';
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
            'name' => 'Prioridade',
        ];
    }

    public function getModTaskLists()
    {
        return $this->hasMany(ModTaskList::className(), ['priority_id' => 'id']);
    }
}
