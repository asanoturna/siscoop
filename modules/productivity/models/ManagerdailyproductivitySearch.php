<?php

namespace app\modules\productivity\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\productivity\models\Managerdailyproductivity;

class ManagerdailyproductivitySearch extends Managerdailyproductivity
{
    public $start_date;
    public $end_date;    

    public function rules()
    {
        return [
            [['id', 'product_id', 'location_id', 'person_id', 'daily_productivity_status_id', 'seller_id', 'operator_id', 'user_id','manager_id'], 'integer'],
            [['start_date', 'end_date', 'buyer_document', 'buyer_name', 'date', 'created', 'updated', 'is_commission_received'], 'safe'],
            [['value', 'commission_percent', 'companys_revenue'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Managerdailyproductivity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC, 
                ]
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'location_id' => $this->location_id,
            'person_id' => $this->person_id,
            'value' => $this->value,
            'commission_percent' => $this->commission_percent,
            'companys_revenue' => $this->companys_revenue,
            'daily_productivity_status_id' => $this->daily_productivity_status_id,
            'seller_id' => $this->seller_id,
            'operator_id' => $this->operator_id,
            'user_id' => $this->user_id,
            'manager_id' => $this->manager_id,
            'date' => $this->date,
            'created' => $this->created,
            'updated' => $this->updated,
            'is_commission_received' => $this->is_commission_received,
        ]);

        $query->andFilterWhere(['between', 'date', $this->start_date, $this->end_date]);          

        $query->andFilterWhere(['like', 'buyer_document', $this->buyer_document])
            ->andFilterWhere(['like', 'buyer_name', $this->buyer_name]);

        return $dataProvider;
    }
}
