<?php

namespace app\modules\campaign\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\campaign\models\Recovery;

class RecoverySearch extends Recovery
{
    public function rules()
    {
        return [
            [['id', 'negotiator_id', 'location_id', 'typeproposed', 'status', 'approvedby'], 'integer'],
            [['typeofdebt', 'expirationdate', 'clientname', 'clientdoc', 'contracts', 'date', 'approvedin'], 'safe'],
            [['referencevalue', 'value_traded', 'value_input', 'commission'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Recovery::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'negotiator_id' => $this->negotiator_id,
            'location_id' => $this->location_id,
            'value_traded' => $this->value_traded,
            'value_input' => $this->value_input,
            'referencevalue' => $this->referencevalue,
            'typeproposed' => $this->typeproposed,
            'commission' => $this->commission,
            'status' => $this->status,
            'date' => $this->date,
            'approvedby' => $this->approvedby,
            'approvedin' => $this->approvedin,
        ]);

        $query->andFilterWhere(['like', 'clientname', $this->clientname])
            ->andFilterWhere(['like', 'typeofdebt', $this->typeofdebt])
            ->andFilterWhere(['like', 'expirationdate', $this->expirationdate])
            ->andFilterWhere(['like', 'clientdoc', $this->clientdoc])
            ->andFilterWhere(['like', 'contracts', $this->contracts]);

        return $dataProvider;
    }
}
