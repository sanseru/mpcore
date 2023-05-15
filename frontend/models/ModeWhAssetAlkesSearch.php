<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModeWhAssetAlkes;

/**
 * ModeWhAssetAlkesSearch represents the model behind the search form of `frontend\models\ModeWhAssetAlkes`.
 */
class ModeWhAssetAlkesSearch extends ModeWhAssetAlkes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codeAset', 'noAsset_SAP', 'noInventory', 'namaAlat', 'merk', 'tipe', 'noSeri', 'lokasi', 'tglBeli', 'tglKalibrasi','tglexpKalibrasi', 'Supplier', 'kondisi'], 'safe'],
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
        $query = ModeWhAssetAlkes::find();

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
        ]);

        $query->andFilterWhere(['like', 'codeAset', $this->codeAset])
            ->andFilterWhere(['like', 'noAsset_SAP', $this->noAsset_SAP])
            ->andFilterWhere(['like', 'noInventory', $this->noInventory])
            ->andFilterWhere(['like', 'namaAlat', $this->namaAlat])
            ->andFilterWhere(['like', 'merk', $this->merk])
            ->andFilterWhere(['like', 'tipe', $this->tipe])
            ->andFilterWhere(['like', 'noSeri', $this->noSeri])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'Supplier', $this->Supplier])
            ->andFilterWhere(['like', 'kondisi', $this->kondisi])
            ->andFilterWhere(['like', 'tglBeli', $this->tglBeli])
            ->andFilterWhere(['like', 'tglexpKalibrasi', $this->tglexpKalibrasi])
            ->andFilterWhere(['like', 'tglKalibrasi', $this->tglKalibrasi]);



        return $dataProvider;
    }
}
