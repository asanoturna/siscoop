<?php

namespace app\modules\productivity\models;
use app\models\User;
use app\models\Location;
use app\models\Person;

use Yii;


class Dailyproductivity extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //$companys_revenue = ($this->value*$this->commission_percent)/100;
            //$companys_revenue = $companys_revenue*0.75;
            //$this->companys_revenue = abs($companys_revenue);

            //SEGUROS
            if($this->product_id >= 1 && $this->product_id <= 99){
                $companys_revenue = ($this->value*$this->commission_percent)/100;
                $companys_revenue = $companys_revenue*0.75;
                $this->companys_revenue = abs($companys_revenue);
            //CONSORCIO
            }elseif($this->product_id >= 100 && $this->product_id <= 199){
                $companys_revenue = ($this->value*$this->commission_percent)/100;
                $this->companys_revenue = abs($companys_revenue);
            // FIM REGRA CONSORCIO
            }elseif($this->product_id == 201){
                //CIELO
                $this->companys_revenue = 0;
                $this->value = 0;
            }elseif($this->product_id == 202){
                //REDECARD
                $this->companys_revenue = 17.08;
                $this->value = 0;
            }elseif($this->product_id == 203){
                //SIPAG
                $this->companys_revenue = 60;
                $this->value = 0;
            }elseif($this->product_id == 501){
                //SEGURO PPR
                $this->companys_revenue = 0.64;
                $this->value = 0; 
            }elseif($this->product_id == 502){
                //SMS ILIMITADO
                $this->companys_revenue = 0.30;
                $this->value = 0;
            }elseif($this->product_id == 503){
                //CDC Sicoobcard
                switch($this->prazo){
                    case ($this->prazo == 2):
                        $this->commission_percent = 2.30;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 3):
                        $this->commission_percent = 4.60;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 4):
                        $this->commission_percent = 6.90;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;       
                    case ($this->prazo == 5):
                        $this->commission_percent = 9.20;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;        
                    case ($this->prazo == 6):
                        $this->commission_percent = 11.30;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;  
                    case ($this->prazo == 7):
                        $this->commission_percent = 13.60;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 8):
                        $this->commission_percent = 15.90;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 9):
                        $this->commission_percent = 18.20;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 10):
                        $this->commission_percent = 20.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 11):
                        $this->commission_percent = 22.80;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break; 
                    case ($this->prazo == 12):
                        $this->commission_percent = 25.10;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;                                                 
                }                 
            }elseif($this->product_id == 301){
                //CABAL VALE
                $this->companys_revenue = 35.00;
                $this->value = 0;   
            }elseif($this->product_id == 801){
                //SEPLAg
                switch($this->prazo){
                    case ($this->prazo >= 6 && $this->prazo <= 10):
                        $this->commission_percent = 0.9;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 11):
                        $this->commission_percent = 0.45;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 12):
                        $this->commission_percent = 0.9;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 13 && $this->prazo <=15):
                        $this->commission_percent = 1.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 16 && $this->prazo <= 18):
                        $this->commission_percent = 2.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 19 && $this->prazo <= 22):
                        $this->commission_percent = 3.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 23):
                        $this->commission_percent = 1.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 24):
                        $this->commission_percent = 3.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 25 && $this->prazo <= 30):
                        $this->commission_percent = 5.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 31 && $this->prazo <= 34):
                        $this->commission_percent = 6.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 35):
                        $this->commission_percent = 4.50;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 36):
                        $this->commission_percent = 6.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 37 && $this->prazo <= 41):
                        $this->commission_percent = 8.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 42 && $this->prazo <= 46):
                        $this->commission_percent = 10.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 47):
                        $this->commission_percent= 8.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 48):
                        $this->commission_percent = 10.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 59 && $this->prazo <= 54):
                        $this->commission_percent = 10.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 55 && $this->prazo <= 58):
                        $this->commission_percent = 11.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 59):
                        $this->commission_percent = 7.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo == 60):
                        $this->commission_percent = 13.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    }
                    $this->value = 0; 
            }elseif($this->product_id == 802){
                //INSS
                switch($this->prazo){
                    case ($this->prazo >= 6 && $this->prazo <= 11):
                        $this->commission_percent = 1.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 12 && $this->prazo <= 17):
                        $this->commission_percent = 5.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 18 && $this->prazo <= 23):
                        $this->commission_percent = 4.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 24 && $this->prazo <= 29):
                        $this->commission_percent = 3.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 30 && $this->prazo <= 35):
                        $this->commission_percent = 1.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 36 && $this->prazo <= 41):
                        $this->commission_percent = 14.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 42 && $this->prazo <= 47):
                        $this->commission_percent = 12.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 48 && $this->prazo <= 53):
                        $this->commission_percent = 11.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 54 && $this->prazo <= 59):
                        $this->commission_percent = 8.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 60 && $this->prazo <= 72):
                        $this->commission_percent = 10.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    }   
                    $this->value = 0; 
            }elseif($this->product_id == 803){
                //CDL
                switch($this->prazo){
                    case ($this->prazo >= 3 && $this->prazo <= 3):
                        $this->commission_percent = 1.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 4 && $this->prazo <= 6):
                        $this->commission_percent = 2.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 7 && $this->prazo <= 12):
                        $this->commission_percent = 4.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;       
                    case ($this->prazo >= 13 && $this->prazo <= 18):
                        $this->commission_percent = 6.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;        
                    case ($this->prazo >= 19 && $this->prazo <= 24):
                        $this->commission_percent = 8.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;                                                         
                }    
                $this->value = 0;                        
            }elseif($this->product_id == 804){
                //Prebiteriano
                switch($this->prazo){
                    case ($this->prazo >= 3 && $this->prazo <= 3):
                        $this->commission_percent = 0.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 4 && $this->prazo <= 6):
                        $this->commission_percent = 1.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 7 && $this->prazo <= 12):
                        $this->commission_percent = 2.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;       
                    case ($this->prazo >= 13 && $this->prazo <= 18):
                        $this->commission_percent = 2.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;        
                    case ($this->prazo >= 19 && $this->prazo <= 24):
                        $this->commission_percent = 3.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;                                                         
                }  
            }elseif($this->product_id == 805){
                //Prefeitura
                switch($this->prazo){
                    case ($this->prazo >= 6 && $this->prazo <= 11):
                        $this->commission_percent = 1.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 12 && $this->prazo <= 17):
                        $this->commission_percent = 2.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;
                    case ($this->prazo >= 18 && $this->prazo <= 23):
                        $this->commission_percent = 2.5;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;       
                    case ($this->prazo >= 24 && $this->prazo <= 29):
                        $this->commission_percent = 3.5;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;        
                    case ($this->prazo >= 30 && $this->prazo <= 35):
                        $this->commission_percent = 4.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;     
                    case ($this->prazo >= 36 && $this->prazo <= 41):
                        $this->commission_percent = 5.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;    
                    case ($this->prazo >= 42 && $this->prazo <= 47):
                        $this->commission_percent = 6.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;     
                    case ($this->prazo >= 48 && $this->prazo <= 53):
                        $this->commission_percent = 7.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;    
                    case ($this->prazo >= 54 && $this->prazo <= 59):
                        $this->commission_percent = 9.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break; 
                    case ($this->prazo >= 60 && $this->prazo <= 60):
                        $this->commission_percent = 11.00;
                        $companys_revenue = ($this->value*$this->commission_percent)/100;
                        $this->companys_revenue = abs($companys_revenue);
                        break;                                                                                                                               
                }                  
                $this->value = 0;                         
            }elseif($this->product_id == 901){
                //MODULO CEDENTE
                $this->value = 0;
            }
            //$this->quantity = 1;
            return true;
        } else {
            return false;
        }

    }

    public $mounth;
    public $year;  
    public $prazo;

    public static function tableName()
    {
        return 'daily_productivity';
    }

    public function rules()
    {
        return [
            [['person_id', 'location_id', 'product_id', 'commission_percent','daily_productivity_status_id', 'buyer_document', 'buyer_name', 'seller_id', 'operator_id', 'user_id','date', 'created', 'updated'], 'required', 'message' => 'Campo Obrigatório'],
            [['quantity', 'person_id', 'location_id', 'product_id', 'daily_productivity_status_id', 'seller_id', 'operator_id', 'user_id'], 'integer', 'message' => 'Preencha corretamente'],
            [['value'], 'number'],
            [['value',], 'required', 'message' => 'Campo obrigatório!', 'when' => function ($model) {
                    return $model->product_id <= 37;
                    }, 'whenClient' => "function(attribute, value) {
                      return $('#dailyproductivity-product_id').val() <= 37;
                  }"],
            [['prazo','date', 'companys_revenue','created', 'updated'], 'safe'],
            [['buyer_name'], 'string', 'max' => 100],
            [['buyer_document'], 'string', 'max' => 18],
            //[['commission_percent'],'number','min'=>10,'max'=>100],
            ['commission_percent', 'number','min'=>0,'max'=>100],// the general values
            //['commission_percent', 'validateCom'],
        ];
    }
    // public function validateCom($attribute)
    // {
    //     if ($this->product_id == 14) {
    //         $min = 10;
    //         $max = 25;

    //         if ($this->attribute < $min || $this->attribute > $max) {
    //             $this->addError($attribute, 'error message');
    //         }
    //     }
    // }
    // public function checkValues($attribute)
    // {
    //     $persona = $this->NUM_PERSONAS;
    //     $agua = $this->AGUA_CONSUMO%2 == 0 ? $this->AGUA_CONSUMO : $this->AGUA_CONSUMO - 1;
    //     if ($persona != $agua/2) {
    //         $this->addError($attribute, 'Error message');
    //     }
    // }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'PA',
            'product_id' => 'Produto',
            'person_id' => 'Pessoa',
            'value' => 'Valor',
            'quantity' => 'Quantidade',
            'commission_percent' => 'Comissão (%)',
            'prazo_mes' => 'Prazo',
            'companys_revenue' => 'Receita da Cooperativa',
            'daily_productivity_status_id' => 'Situação',
            'buyer_document' => 'CPF/CNPJ Cliente',
            'buyer_name' => 'Nome Cliente',
            'seller_id' => 'Indicador',
            'operator_id' => 'Angariador',
            'user_id' => 'Usuário',
            'date' => 'Data',
            'created' => 'Criado',
            'updated' => 'Alterado',
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

}