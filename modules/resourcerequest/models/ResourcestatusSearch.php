<?php

namespace app\modules\resourcerequest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\resourcerequest\models\Resourcestatus;

class ResourcestatusSearch extends Resourcestatus
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'hexcolor'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Resourcestatus::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hexcolor', $this->hexcolor]);

        return $dataProvider;
    }
}
