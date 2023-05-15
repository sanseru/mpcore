<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelInvTrackHead;

/**
 * ModelInvTrackHeadSearch represents the model behind the search form of `frontend\models\ModelInvTrackHead`.
 */
class ModelInvTrackHeadSearch extends ModelInvTrackHead
{
    /**
     * {@inheritdoc}
     */
    public $status_inv;

    public function rules()
    {
        return [
            [['id', 'noinvoice', 'perusahaan', 'created_by', 'created_time','status_inv'], 'safe'],
            [['status'], 'integer'],
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
        $query = ModelInvTrackHead::find();
        $query->joinWith(['invStatus']);
        $query->orderBy(['id'=>SORT_DESC]);

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
            'status' => $this->status,
            'created_time' => $this->created_time,
        ]);
        $query->andFilterWhere(['like', 'INV_STATUS.status', $this->status_inv]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'noinvoice', $this->noinvoice])
            ->andFilterWhere(['like', 'perusahaan', $this->perusahaan])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
