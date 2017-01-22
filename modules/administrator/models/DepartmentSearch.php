<?php

namespace app\modules\administrator\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\Department;

class DepartmentSearch extends Department
{
    public function rules()
    {
        return [
            [['id', 'is_active'], 'integer'],
            [['name', 'description', 'email', 'hexcolor'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Department::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC, 
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hexcolor', $this->hexcolor])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
