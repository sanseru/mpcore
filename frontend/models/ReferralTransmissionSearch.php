<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelReferralTransmission;

/**
 * ReferralTransmissionSearch represents the model behind the search form of `frontend\models\ModelReferralTransmission`.
 */
class ReferralTransmissionSearch extends ModelReferralTransmission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idreferral', 'status'], 'integer'],
            [['description', 'remainderdate', 'created_by', 'created_at'], 'safe'],
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
        $query = ModelReferralTransmission::find();
        $query->where(['idreferral'=>$params['id']]);
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
            'idreferral' => $this->idreferral,
            'remainderdate' => $this->remainderdate,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }

    public function searchpending($params)
    {
        $query = ModelReferralTransmission::find();
        $query->where(['status'=>0]);
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
            'idreferral' => $this->idreferral,
            'remainderdate' => $this->remainderdate,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
