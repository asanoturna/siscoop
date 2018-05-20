<?php

namespace app\modules\resourcerequest\models;
use app\models\User;
use app\models\Location;
use Yii;

class Resourcerequest extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'resource_request';
    }   

    public static $Static_has_transfer      = ['NÃO', 'SIM'];

    public static $Static_receive_credit    = ['NÃO', 'SIM']; 

    public static $Static_add_insurance     = ['NÃO', 'SIM'];

    public static $Static_requested_month   = [
        'JANEIRO', 
        'FEVEREIRO', 
        'MARÇO', 
        'ABRIL',
        'MAIO',
        'JUNHO',
        'JULHO',
        'AGOSTO',
        'SETEMBRO',
        'OUTUBRO',
        'NOVEMBRO',
        'DEZEMBRO'
        ];

    public static $Static_requested_year    = ['2016', '2017', '2018', '2019', '2020'];   

    public static $Static_resource_purposes = [
        'CUSTEIO AGRICOLA', 
        'CUSTEIO PECUARIO', 
        'INVESTIMENTO AGRICOLA', 
        'INVESTIMENTO PECUARIO'
        ];

    public static $Static_resource_type = [
        'FUNCAFE', 
        'POUPANÇA EQUALIZAVEL', 
        'PRONAMP', 
        'PRONAF NIVEL I',
        'PRONAF NIVEL II',
        'PRONAF NIVEL III',
        'RECURSOS OBRIGATORIOS',
        'RPL'
        ];        


    public function getRequestedMonthValue()
    {
        if ($this->requested_month === null) {
            return null;
        }
        return self::$Static_requested_month[$this->requested_month];
    }

    public function getRequestedYearValue()
    {
        if ($this->requested_year === null) {
            return null;
        }
        return self::$Static_requested_year[$this->requested_year];
    }    

    public function getResourcePurposes()
    {
        if ($this->resource_purposes === null) {
            return null;
        }
        return self::$Static_resource_purposes[$this->resource_purposes];
    }      

    public function getResourceType()
    {
        if ($this->resource_type === null) {
            return null;
        }
        return self::$Static_resource_type[$this->resource_type];
    }       

    public function rules()
    {
        return [
            [['created', 'client_name', 'client_phone', 'value_request', 'expiration_register', 'lastupdate_register', 'value_capital', 'requested_month', 'requested_year', 'resource_purposes', 'location_id', 'user_id', 'resource_type', 'resource_status_id','has_transfer', 'receive_credit', 'add_insurance'], 'required'],
            [['created', 'expiration_register', 'lastupdate_register'], 'safe'],
            [['value_request', 'value_capital'], 'number', 'min' => 500, 'message' => '{attribute} Valor precisa ser maior que 500'],
            [['observation', 'observation_status'], 'string'],
            [['location_id', 'user_id', 'resource_status_id', 'requested_month', 'requested_year', 'resource_purposes', 'resource_type', 'has_transfer', 'receive_credit', 'add_insurance', 'manager_id'], 'integer'],
            [['client_name'], 'string', 'max' => 200],
            [['client_phone'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Inserido em',
            'client_name' => 'Nome do Cliente',
            'client_phone' => 'Telefone do Cliente',
            'value_request' => 'Valor Solicitado',
            'value_capital' => 'Valor do Capital Social',
            'expiration_register' => 'Vencimento do Cadastro',
            'lastupdate_register' => 'Ultima Atualização Cadastral',            
            'observation' => 'Observação',
            'observation_status' => 'Sobre a Situação',
            'has_transfer' => 'Possui Repasse?',
            'receive_credit' => 'Recebe credito de leite em C/C?',
            'add_insurance' => 'Adesão Seguro Prestamista?',
            'requested_month' => 'Mes',
            'requested_year' => 'Ano',
            'resource_purposes' => 'Finalidade',
            'location_id' => 'PA',
            'user_id' => 'Usuário',
            'resource_type' => 'Tipo do Recurso',
            'resource_status_id' => 'Situação',
            'manager_id' => 'Alterado por',
        ];
    }

    public function getResourceStatus()
    {
        return $this->hasOne(Resourcestatus::className(), ['id' => 'resource_status_id']);
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }      
    
    public function getManager()
    {
        return $this->hasOne(User::className(), ['id' => 'manager_id']);
    }     
}
