<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Subject;

/**
 * SubjectSearch represents the model behind the search form of `backend\models\Subject`.
 */
class SubjectSearch extends Subject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'okato', 'population', 'population_rising', 'territory', 'created_at', 'updated_at'], 'integer'],
            [['subject', 'administrative_center', 'gerb', 'imagePath'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Subject::find();

        $query->joinWith(['statuses']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['created_at', 'subject','population_rising', 'status_id']],
        ]);

        $dataProvider->sort->attributes['statuses.status_id'] = [
            'asc' => ['statuses.id' => SORT_ASC],
            'desc' => ['statuses.id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'statuses.id' => $this->status_id,
            'population_rising' => $this->population_rising,
            'created_at' => $this->created_at,
        ]);
        

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'population_rising', $this->population_rising])
            ->andFilterWhere(['like', 'statuses.id', $this->status_id])
            ->andFilterWhere(['>=', 'created_at', $this->created_at]);

        return $dataProvider;
    }
    
}
