<?php

namespace app\modules\campaign\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\campaign\models\Sicoobcard;

class SicoobcardSearch extends Sicoobcard
{
    public function rules()
    {
        return [
            [['id', 'product_type', 'location_id', 'user_id','status','approved_by'], 'integer'],
            [['name', 'purchaselocal', 'card', 'purchasedate', 'created', 'updated'], 'safe'],
            [['purchasevalue'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sicoobcard::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, 
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
            'purchasedate' => $this->purchasedate,
            'purchasevalue' => $this->purchasevalue,
            'product_type' => $this->product_type,
            'location_id' => $this->location_id,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'purchaselocal', $this->purchaselocal])
            ->andFilterWhere(['like', 'card', $this->card]);

        return $dataProvider;
    }
}