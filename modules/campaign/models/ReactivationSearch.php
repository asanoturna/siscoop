<?php

namespace app\modules\campaign\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\campaign\models\Reactivation;

class ReactivationSearch extends Reactivation
{
    public function rules()
    {
        return [
            [['agent_visit_number'], 'number'],
            [[
            'id','client_name',
            'client_doc',
            'client_risk',
            'client_last_renovated_register',
            'client_income',
            'agent_card_value',
            'restrictions_serasa',
            'restrictions_ccf',
            'restrictions_scr',
            'agent_registration_renewal',
            'agent_overdraft_value',
            'supervisor_package_rate',
            'manager_inactive_meeting',
            'manager_approval',
            'manager_final_opinion'], 'safe'],
            [['location_id', 'user_id'], 'integer'],

        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Reactivation::find();

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
        'location_id' => $this->location_id,
        'client_risk' => $this->client_risk,
        'client_last_renovated_register' => $this->client_last_renovated_register,
        'restrictions_serasa' => $this->restrictions_serasa,
        'restrictions_ccf' => $this->restrictions_ccf,
        'restrictions_scr' => $this->restrictions_scr,
        'user_id' => $this->user_id,
        'agent_registration_renewal' => $this->agent_registration_renewal,
        'agent_overdraft_value' => $this->agent_overdraft_value,
        'agent_card_value' => $this->agent_card_value,
        'supervisor_package_rate' => $this->supervisor_package_rate,
        'manager_inactive_meeting' => $this->manager_inactive_meeting,
        'manager_approval' => $this->manager_approval,
        'manager_final_opinion' => $this->manager_final_opinion,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_doc', $this->client_doc])
            ->andFilterWhere(['like', 'agent_visit_number', $this->agent_visit_number]);

        return $dataProvider;
    }
}