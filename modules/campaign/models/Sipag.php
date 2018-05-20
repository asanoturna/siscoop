<?php

namespace app\modules\campaign\models;
use app\models\User;
use Yii;

class Sipag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'campaign_sipag';
    }

    public $tax;
    public $file;

    // establishmenttype
    public static $Static_establishmenttype = [
        'RESTAURANTE', // 0
        'ALIMENTAÇÃO EMERCADOS ESPECIAIS', // 1
        'SUPERMERCADO', // 2
        'AUTOPOSTO', // 3
        'ACADEMIA', // 4
        'ESCOLAS', // 5
        'HOTEIS', // 6
        'LOJAS', // 7
        'DENTISTAS', // 8
        'MEDICOS', // 9
        'LABORATORIOS', // 10
        'HOSPITAIS', // 11
        'ASSOCIADO PJ SEM SIPAG', //12
        'SIPAG CANCELADO', //13
        'SIPAG SUSPENSO', //14
        ];
    public function getEstablishmenttype()
    {
        if ($this->establishmenttype === null) {
            return null;
        }
        return self::$Static_establishmenttype[$this->establishmenttype];
    }  

    // visited
    public static $Static_visited = [
        'SIM', 
        'NÃO', 
        ];   
    public function getVisited()
    {
        if ($this->visited === null) {
            return null;
        }
        return self::$Static_visited[$this->visited];
    }

    // accredited
    public static $Static_accredited = [
        'SIM', //0
        'NÃO', //1
        // 'SIPAG', 
        // 'CIELO', 
        // 'REDE',
        'OUTROS', //2
        'PENDENTE', //3
        ];
    public function getAccredited()
    {
        if ($this->accredited === null) {
            return null;
        }
        return self::$Static_accredited[$this->accredited];
    } 

    // locked
    public static $Static_locked = [
        'SIM', 
        'NÃO', 
        ];   
    public function getLocked()
    {
        if ($this->status === null) {
            return null;
        }
        return self::$Static_locked[$this->locked];
    } 

    //anticipation
    public static $Static_anticipation = [
        'SIM', 
        'NÃO', 
        ];   
    public function getAnticipation()
    {
        if ($this->status === null) {
            return null;
        }
        return self::$Static_anticipation[$this->anticipation];
    } 

    // status
    public static $Static_status = [
        'SIM', 
        'NÃO', 
        ];   
    public function getStatus()
    {
        if ($this->status === null) {
            return null;
        }
        return self::$Static_status[$this->status];
    }

    // flag_sipag
    public static $Static_flag_sipag = [
        'NÃO', 
        'SIM', 
        ];   
    public function getFlagsipag()
    {
        if ($this->flag_sipag === null) {
            return null;
        }
        return self::$Static_flag_sipag[$this->flag_sipag];
    }
    // flag_sipag_locked
    public static $Static_flag_sipag_locked = [
        'NÃO', 
        'SIM',
        ];   
    public function getFlagsipaglocked()
    {
        if ($this->flag_sipag_locked === null) {
            return null;
        }
        return self::$Static_flag_sipag_locked[$this->flag_sipag_locked];
    }


    // flag_rede
    public static $Static_flag_rede = [
        'NÃO', 
        'SIM', 
        ];   
    public function getFlagrede()
    {
        if ($this->flag_rede === null) {
            return null;
        }
        return self::$Static_flag_rede[$this->flag_rede];
    }
    // flag_rede_locked
    public static $Static_flag_rede_locked = [
        'NÃO', 
        'SIM',  
        ];   
    public function getFlagredelocked()
    {
        if ($this->flag_rede_locked === null) {
            return null;
        }
        return self::$Static_flag_rede_locked[$this->flag_rede_locked];
    }


    // flag_cielo
    public static $Static_flag_cielo = [
        'NÃO', 
        'SIM',  
        ];   
    public function getFlagcielo()
    {
        if ($this->flag_cielo === null) {
            return null;
        }
        return self::$Static_flag_cielo[$this->flag_cielo];
    }
    // flag_cielo_locked
    public static $Static_flag_cielo_locked = [
        'NÃO', 
        'SIM', 
        ];   
    public function getFlagcielolocked()
    {
        if ($this->flag_cielo_locked === null) {
            return null;
        }
        return self::$Static_flag_cielo_locked[$this->flag_cielo_locked];
    }  

    // situation
    public static $Static_situation = [
        'NÃO', 
        'SIM', 
        ];   
    public function getSituation()
    {
        if ($this->situation === null) {
            return null;
        }
        return self::$Static_situation[$this->situation];
    }

    public function rules()
    {
        return [
            [['establishmenttype', 'establishmentname','visited', 'accredited', 'status', 'locked', 'anticipation', 'status','flag_sipag', 'flag_sipag_locked', 'flag_rede', 'flag_rede_locked', 'flag_cielo', 'flag_cielo_locked', 'situation'], 'required'],
            [['establishmenttype', 'visited', 'accredited', 'status', 'locked', 'anticipation', 'status', 'user_id', 'checkedby_id','flag_sipag', 'flag_sipag_locked', 'flag_rede', 'flag_rede_locked', 'flag_cielo', 'flag_cielo_locked'], 'integer'],
            [['date', 'created', 'updated'], 'safe'],
            [['observation'], 'string'],
            [['establishmentname', 'address', 'expedient'], 'string'],
            [['establishmentname', 'address', 'expedient'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Criado em',
            'updated' => 'Alterado em',            
            'establishmenttype' => 'Tipo do Estabelecimento',
            'establishmentname' => 'Estabelecimento',
            'address' => 'Endereço',
            'expedient' => 'Expediente',
            'visited' => 'Visitado',
            'accredited' => 'Credenciado',
            'locked' => 'Travado',                        
            'anticipation' => 'Antec. Efet.',
            'status' => 'Ativo',                        
            'user_id' => 'Gerente',
            'checkedby_id'=> 'Aprovado por',
            'date' => 'Aprovado em',
            'observation' => 'Observação',
            'flag_sipag' => 'SIPAG',
            'flag_sipag_locked' => 'SIPAG Travado',
            'flag_rede' => 'REDE',
            'flag_rede_locked' => 'REDE Travado',
            'flag_cielo' => 'CIELO',
            'flag_cielo_locked' => 'CIELO Travado',
            'situation' => 'Aprovado?',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCheckedby()
    {
        return $this->hasOne(User::className(), ['id' => 'checkedby_id']);
    }       
}