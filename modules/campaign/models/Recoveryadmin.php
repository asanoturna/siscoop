<?php

namespace app\modules\campaign\models;
use app\models\User;
use app\models\Location;
use Yii;

class Recoveryadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'campaign_recovery';
    }

    // status
    public static $Static_status = [
        'PENDENTE', 
        'APROVADO', 
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
            [['status', 'referencevalue'], 'required'],
            [['status'], 'integer'],
            [['referencevalue'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expirationdate' => 'Data de Vencimento',
            'typeofdebt' => 'Tipo de Dívida',
            'clientname' => 'Associado',
            'clientdoc' => 'CPF/CNPJ',
            'referencevalue' => 'Valor Referência',
            'negotiator_id' => 'Negociador',
            'location_id' => 'PA',
            'contracts' => 'Contratos',
            'value_traded' => 'Valor Negociado',
            'value_input' => 'Valor da Quitação ou Entrada',
            'typeproposed' => 'Proposta Selecionada',
            'commission' => 'Comissão',
            'status' => 'Situação',
            'date' => 'Data da Operação',
            'approvedby' => 'Aprovado Por',
            'approvedin' => 'Aprovado Em',
        ];
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getCheckedby()
    {
        return $this->hasOne(User::className(), ['id' => 'approvedby']);
    }
}