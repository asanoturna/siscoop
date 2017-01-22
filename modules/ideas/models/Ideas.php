<?php

namespace app\modules\ideas\models;
use app\models\User;
use Yii;


class Ideas extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'ideas';
    }

    // type
    public static $Static_type = [
        'Estrutura Física',
        'Marketing',
        'Produtos',
        'Prejuizo',
        'Atendimento',
        'Crédito',
        'Cobrança',
        'Tecnologia',
        'Controle Interno',
        'Contabilidade',
        'Comunidade',
        ];   
    public function getType()
    {
        if ($this->type === null) {
            return null;
        }
        return self::$Static_type[$this->type];
    }
    // status
    public static $Static_status = [
        'Aguardando Análise',
        'Em Análise',
        'Aprovada',
        'Executada',
        'Indeferida',
        ];
    public function getStatus()
    {
        if ($this->status === null) {
            return null;
        }
        return self::$Static_status[$this->status];
    } 

    public function rules()
    {
        return [
            [['user_id', 'type', 'title', 'description', 'objective', 'viability'], 'required'],
            [['user_id', 'type', 'status'], 'integer'],
            [['description', 'objective'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['viability'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuário',
            'type' => 'Área',
            'title' => 'Título',
            'description' => 'Descrição',
            'objective' => 'Objetivo',
            'viability' => 'Viabilidade',
            'status' => 'Situação',
            'created' => 'Inserido em',
            'updated' => 'Alterado em',
            'answer' => 'Resposta',
            'committee_id' => 'Membro Comitê',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }    
}
