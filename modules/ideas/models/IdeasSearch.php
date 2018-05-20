<?php

namespace app\modules\ideas\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ideas\models\Ideas;

/**
 * IdeasSearch represents the model behind the search form about `app\modules\ideas\models\Ideas`.
 */
class IdeasSearch extends Ideas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'status', 'created', 'updated', 'answer', 'committee_id'], 'integer'],
            [['title', 'description', 'objective', 'viability'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ideas::find();

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
            'user_id' => $this->user_id,
            'type' => $this->type,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'answer' => $this->answer,
            'committee_id' => $this->committee_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'objective', $this->objective])
            ->andFilterWhere(['like', 'viability', $this->viability]);

        return $dataProvider;
    }
}
