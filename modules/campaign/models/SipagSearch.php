<?php

namespace app\modules\campaign\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\campaign\models\Sipag;

class SipagSearch extends Sipag
{
    public function rules()
    {
        return [
            [['id', 'establishmenttype', 'visited', 'accredited', 'status', 'locked', 'anticipation', 'user_id', 'checkedby_id','flag_sipag', 'flag_sipag_locked', 'flag_rede', 'flag_rede_locked', 'flag_cielo', 'flag_cielo_locked','situation'], 'integer'],
            [['establishmentname', 'address', 'date', 'created', 'updated','observation'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sipag::find();

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
            'updated' => $this->updated,
            'establishmenttype' => $this->establishmenttype,
            'date' => $this->date,
            'visited' => $this->visited,
            'accredited' => $this->accredited,
            'locked' => $this->locked,
            'anticipation' => $this->anticipation,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'flag_sipag' => $this->flag_sipag,
            'flag_sipag_locked' => $this->flag_sipag_locked,
            'flag_rede' => $this->flag_rede,
            'flag_rede_locked' => $this->flag_rede_locked,
            'flag_cielo' => $this->flag_cielo,
            'flag_cielo_locked' => $this->flag_cielo_locked,
            'situation' => $this->situation,           
        ]);

        $query->andFilterWhere(['like', 'establishmentname', $this->establishmentname])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'observation', $this->observation]);;

        return $dataProvider;
    }
}