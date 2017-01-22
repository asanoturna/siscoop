<?php

namespace app\modules\archive\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\archive\models\File;

class FileSearch extends File
{
    public function rules()
    {
        return [
            [['id', 'archive_category_id', 'downloads', 'filesize', 'is_active', 'user_id'], 'integer'],
            [['name', 'attachment', 'description', 'created', 'updated', 'filetype'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = File::find();

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
            'archive_category_id' => $this->archive_category_id,
            'downloads' => $this->downloads,
            'filesize' => $this->filesize,
            'created' => $this->created,
            'updated' => $this->updated,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'filetype', $this->filetype]);

        return $dataProvider;
    }
}
