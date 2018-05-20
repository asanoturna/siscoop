<?php

namespace app\modules\productivity\models;
use app\models\User;
use app\models\Location;
use app\models\Person;

use Yii;

class Managerdailyproductivity extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->daily_productivity_status_id == 2){
                $this->manager_id = Yii::$app->user->id;
            } 
            return true;
        } else {
            return false;
        }
    }    

    public static function tableName()
    {
        return 'daily_productivity';
    }

    public function rules()
    {
        return [
            [['product_id', 'location_id', 'person_id', 'value', 'commission_percent', 'companys_revenue', 'daily_productivity_status_id', 'buyer_document', 'buyer_name', 'seller_id', 'operator_id', 'date', 'created', 'updated'], 'required'],
            [['product_id', 'location_id', 'person_id', 'daily_productivity_status_id', 'seller_id', 'operator_id','manager_id'], 'integer'],
            [['value', 'commission_percent', 'companys_revenue'], 'number'],
            [['date', 'created', 'updated', 'is_commission_received'], 'safe'],
            [['buyer_name'], 'string', 'max' => 100],
            [['buyer_document'], 'string', 'max' => 18]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'PA',
            'product_id' => 'Produto',
            'person_id' => 'Pessoa',
            'value' => 'Valor',
            'commission_percent' => 'Comissão (%)',
            'companys_revenue' => 'Receita da Cooperativa',
            'daily_productivity_status_id' => 'Situação',
            'buyer_document' => 'CPF/CNPJ',
            'buyer_name' => 'Nome do Cliente',
            'seller_id' => 'Indicador',
            'operator_id' => 'Angariador',
            'manager_id' => 'Aprovador',            
            'user_id' => 'Usuário',
            'date' => 'Data',
            'created' => 'Criado',
            'updated' => 'Alterado',
            'is_commission_received' => 'Recebida',
        ];
    }

    public function getDailyProductivityStatus()
    {
        return $this->hasOne(Dailyproductivitystatus::className(), ['id' => 'daily_productivity_status_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }    

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    public function getSeller()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_id']);
    }

    public function getOperator()
    {
        return $this->hasOne(User::className(), ['id' => 'operator_id']);
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
