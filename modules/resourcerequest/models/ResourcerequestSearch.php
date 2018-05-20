<?php

namespace app\modules\resourcerequest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\resourcerequest\models\Resourcerequest;

class ResourcerequestSearch extends Resourcerequest
{
    public function rules()
    {
        return [
            [['id', 'has_transfer', 'receive_credit', 'add_insurance', 'location_id', 'user_id', 'resource_type', 'resource_purposes', 'resource_status_id'], 'integer'],
            [['created', 'client_name', 'client_phone', 'expiration_register', 'lastupdate_register', 'observation', 'requested_month', 'requested_year'], 'safe'],
            [['value_request', 'value_capital'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Resourcerequest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'value_request' => $this->value_request,
            'expiration_register' => $this->expiration_register,
            'lastupdate_register' => $this->lastupdate_register,
            'value_capital' => $this->value_capital,
            'has_transfer' => $this->has_transfer,
            'receive_credit' => $this->receive_credit,
            'add_insurance' => $this->add_insurance,
            'location_id' => $this->location_id,
            'user_id' => $this->user_id,
            'resource_type' => $this->resource_type,
            'resource_purposes' => $this->resource_purposes,
            'resource_status_id' => $this->resource_status_id,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_phone', $this->client_phone])
            ->andFilterWhere(['like', 'observation', $this->observation])
            ->andFilterWhere(['like', 'requested_month', $this->requested_month])
            ->andFilterWhere(['like', 'requested_year', $this->requested_year]);

        return $dataProvider;
    }
}
