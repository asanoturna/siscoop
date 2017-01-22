<?php

namespace app\modules\task\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mod_task_category';
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
            'name' => 'Periodicidade',
        ];
    }

    public function getModTaskLists()
    {
        return $this->hasMany(ModTaskList::className(), ['category_id' => 'id']);
    }
}
