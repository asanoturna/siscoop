<?php

namespace app\modules\administrator\models;

use Yii;

class Dashboard extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['archive_category_id', 'name', 'attachment', 'created', 'updated', 'user_id'], 'required'],
            [['archive_category_id', 'downloads', 'filesize', 'is_active', 'user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'attachment'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 200],
            [['filetype'], 'string', 'max' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'archive_category_id' => 'Categoria',
            'name' => 'Nome do Arquivo',
            'attachment' => 'Anexo',
            'description' => 'Descrição',
            'downloads' => 'Downloads',
            'filesize' => 'Tamanho',
            'created' => 'Criação',
            'updated' => 'alteração',
            'is_active' => 'Ativo',
            'user_id' => 'Usuário',
            'filetype' => 'Typo',
        ];
    }
}
