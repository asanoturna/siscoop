<?php

namespace app\modules\campaign\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\campaign\models\Capitalaction;

class CapitalactionSearch extends Capitalaction
{
    public function rules()
    {
        return [
            [['id', 'location_id', 'user_id'], 'integer'],
            [['name', 'date1', 'date2', 'progress', 'created', 'updated', 'ip'], 'safe'],
            [['proposed', 'accomplished'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Capitalaction::find();

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
            'proposed' => $this->proposed,
            'accomplished' => $this->accomplished,
            'date1' => $this->date1,
            'date2' => $this->date2,
            'created' => $this->created,
            'updated' => $this->updated,
            'location_id' => $this->location_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'progress', $this->progress])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
