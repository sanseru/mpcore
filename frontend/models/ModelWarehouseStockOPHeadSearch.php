<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelWarehouseStockOPHead;

/**
 * ModelWarehouseStockOPHeadSearch represents the model behind the search form of `frontend\models\ModelWarehouseStockOPHead`.
 */
class ModelWarehouseStockOPHeadSearch extends ModelWarehouseStockOPHead
{
    /**
     * {@inheritdoc}
     */

    public $lokasi;

    public function rules()
    {
        return [
            [['id', 'status','gudang'], 'integer'],
            [['idStockOP', 'tanggal_mulai', 'keterangan', 'createdBy', 'createdTime', 'ModifiedBy', 'ModifiedTime','lokasi'], 'safe'],
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
        $query = ModelWarehouseStockOPHead::find();
        $query->joinWith(['gudangWh']);
        $query->orderBy(['WH_STCKOP_HEAD.id'=>SORT_DESC]);

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
            'tanggal_mulai' => $this->tanggal_mulai,
            'status' => $this->status,
            'createdTime' => $this->createdTime,
            'ModifiedTime' => $this->ModifiedTime,
        ]);

        $query->andFilterWhere(['like', 'WH_GUDANG.name', $this->lokasi]);


        $query->andFilterWhere(['like', 'idStockOP', $this->idStockOP])
            ->andFilterWhere(['like', 'gudang', $this->gudang])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'createdBy', $this->createdBy])
            ->andFilterWhere(['like', 'ModifiedBy', $this->ModifiedBy]);

        return $dataProvider;
    }
}
