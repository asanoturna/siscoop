<?php

namespace app\modules\administrator\models;

use Yii;

class Menuadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'menu_items';
    }

    public function rules()
    {
        return [
            [['name', 'label'], 'required'],
            [['visible', 'parent_id'], 'integer'],
            [['options'], 'string'],
            [['name', 'label'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 25],
            [['url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'label' => 'Título',
            'icon' => 'Ícone',
            'url' => 'URL',
            'visible' => 'Situação',
            'options' => 'Opções Html',
            'parent_id' => 'Categoria Pai',
        ];
    }
}