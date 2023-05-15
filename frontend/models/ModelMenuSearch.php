<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelMenu;

/**
 * ModelMenuSearch represents the model behind the search form of `frontend\models\ModelMenu`.
 */
class ModelMenuSearch extends ModelMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmenu', 'flag'], 'integer'],
            [['nama_menu', 'link', 'icon'], 'safe'],
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
        $query = ModelMenu::find();

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
            'idmenu' => $this->idmenu,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama_menu', $this->nama_menu])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
