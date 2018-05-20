<?php

namespace app\modules\campaign\models;
use app\models\User;
use app\models\Location;
use Yii;

class Sicoobcard extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'campaign_sicoobcard';
    }

    public $cnt;

    public static $Static_product_type = [
        'ATIVAÇÃO', 
        'REATIVAÇÃO', 
        ];   

    public function getProductType()
    {
        if ($this->product_type === null) {
            return null;
        }
        return self::$Static_product_type[$this->product_type];
    }

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
            [['location_id','name', 'card', 'purchasedate', 'purchasevalue', 'purchaselocal', 'product_type','user_id'], 'required'],
            [['purchasedate', 'created', 'updated'], 'safe'],
            [['purchasevalue'], 'number'],
            [['location_id','product_type', 'user_id','status','approved_by'], 'integer'],
            [['purchaselocal','name'], 'string', 'max' => 100],
            [['card'], 'string', 'max' => 13],
            [['card'], 'string', 'min' => 13, 'message' => 'Favor informar os 13 dígitos'],          
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome Titular',
            'location_id' => 'PA',
            'card' => 'Conta Cartão',
            'purchasedate' => 'Data da Compra',
            'purchasevalue' => 'Valor da Compra',
            'purchaselocal' => 'Local da Compra',
            'product_type' => 'Produto',
            'created' => 'Incluído em',
            'updated' => 'Alterado em',
            'user_id' => 'Usuário',
            'status' => 'Situação',
            'approved_by' => 'Aprovado por',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }  
    public function getApprovedby()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_by']);
    }   

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }                
}