<?php

namespace app\modules\visits\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\visits\models\Visitsimages;

class VisitsimagesSearch extends Visitsimages
{

    public function rules()
    {
        return [
            [['id', 'business_visits_id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Visitsimages::find();

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
            'business_visits_id' => $this->business_visits_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}