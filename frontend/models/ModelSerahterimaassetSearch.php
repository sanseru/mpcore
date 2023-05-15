<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelSerahterimaasset;

/**
 * ModelSerahterimaassetSearch represents the model behind the search form of `frontend\models\ModelSerahterimaasset`.
 */
class ModelSerahterimaassetSearch extends ModelSerahterimaasset
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['User_Name', 'Host_Name', 'Manufacturer', 'Services_Tag', 'Vesion_Product', 'Status_Aset', 'Project', 'Location', 'Addon_Item', 'Date_Asset', 'Created_Time', 'Created_By'], 'safe'],
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
        $query = ModelSerahterimaasset::find();

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
            'Date_Asset' => $this->Date_Asset,
            'Created_Time' => $this->Created_Time,
        ]);

        $query->andFilterWhere(['like', 'User_Name', $this->User_Name])
            ->andFilterWhere(['like', 'Host_Name', $this->Host_Name])
            ->andFilterWhere(['like', 'Manufacturer', $this->Manufacturer])
            ->andFilterWhere(['like', 'Services_Tag', $this->Services_Tag])
            ->andFilterWhere(['like', 'Vesion_Product', $this->Vesion_Product])
            ->andFilterWhere(['like', 'Status_Aset', $this->Status_Aset])
            ->andFilterWhere(['like', 'Project', $this->Project])
            ->andFilterWhere(['like', 'Location', $this->Location])
            ->andFilterWhere(['like', 'Addon_Item', $this->Addon_Item])
            ->andFilterWhere(['like', 'Created_By', $this->Created_By]);

        return $dataProvider;
    }
}
