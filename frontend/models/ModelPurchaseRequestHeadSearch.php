<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelPurchaseRequestHead;

/**
 * ModelPurchaseRequestHeadSearch represents the model behind the search form of `frontend\models\ModelPurchaseRequestHead`.
 */
class ModelPurchaseRequestHeadSearch extends ModelPurchaseRequestHead
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'branch_id', 'department_id'], 'integer'],
            [['requester_name', 'nopr', 'status', 'posting_date', 'required_date', 'created_by', 'created_at', 'update_at', 'update_by', 'description', 'valid_until', 'document_date'], 'safe'],
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
        $query = ModelPurchaseRequestHead::find();

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
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
            'posting_date' => $this->posting_date,
            'required_date' => $this->required_date,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'valid_until' => $this->valid_until,
            'document_date' => $this->document_date,
        ]);

        $query->andFilterWhere(['like', 'requester_name', $this->requester_name])
            ->andFilterWhere(['like', 'nopr', $this->nopr])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
