<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ModelReferralNonMemberLog;

/**
 * ModelReferralNonMemberLogSearch represents the model behind the search form of `frontend\models\ModelReferralNonMemberLog`.
 */
class ModelReferralNonMemberLogSearch extends ModelReferralNonMemberLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tanggal_terima_berkas', 'tanggal_periksa', 'nama_rs', 'no_invoice', 'no_gl', 'nama_peserta', 'jalur_pembuatan', 'client', 'link_dokumen_invoice', 'document_file', 'tanggal_input_link_document', 'tanggal_kirim_dokument_ar_ap', 'remarks_tim_billing', 'link_gl', 'nomer_so', 'nomer_pr', 'tanggal_so_pr', 'nomer_ar', 'remarks_tim_ar', 'nomer_po', 'remarks_tim_procurement', 'nomer_ap', 'remark_tim_ap', 'created_at', 'created_by', 'update_at', 'update_by', 'status_permasalahan', 'created_at_so', 'created_by_so', 'update_at_so', 'update_by_so', 'created_at_ar', 'created_by_ar', 'update_at_ar', 'update_by_ar', 'created_at_po', 'created_by_po', 'update_at_po', 'update_by_po', 'created_at_ap', 'created_by_ap', 'update_at_ap', 'update_by_ap','covteq'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = ModelReferralNonMemberLog::find();
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
            'id' => $this->id,
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
            'covteq' => $this->covteq

        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'covteq', $this->covteq])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // SO & PR Pending
    public function searchsoprpending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        //SO and PR
        $query->Where("ISNULL(LTRIM(RTRIM(nomer_so)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(nomer_pr)),'')=''");

        // Document pending or not
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_gl)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')<>''");
        // $query->andWhere("ISNULL(LTRIM(RTRIM(covteq)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''");

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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // AR Pending
    public function searcharpending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        //SO and PR
        $query->Where("ISNULL(LTRIM(RTRIM(nomer_so)),'')<>''");

        // Document pending or not
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_gl)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''");
        // AR PO AR is null
        $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_ar)),'')=''");

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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // AR AP Pending
    public function searcharappending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        //SO and PR
        $query->Where("ISNULL(LTRIM(RTRIM(nomer_so)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_pr)),'')<>''");
        // Document
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_gl)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''");
        // Tanggal AR AP
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_kirim_dokument_ar_ap)),'')=''");
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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // PO Pending
    public function searchpopending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        $query->Where("ISNULL(LTRIM(RTRIM(nomer_pr)),'')<>''");

        // Document pending or not
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_gl)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''");
        // Tanggal kirim doc
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_kirim_dokument_ar_ap)),'')<>''");
        
        // PO AP is null
        $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_po)),'')=''"); 

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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // AP Pending
    public function searchappending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        $query->Where("ISNULL(LTRIM(RTRIM(no_gl)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')<>''");
        // $query->andWhere("ISNULL(LTRIM(RTRIM(covteq)),'')<>''");
        $query->andWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''");
        // SO and PR
        // $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_pr)),'')<>''"); 
        // $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_so)),'')<>''"); 
        // AR and PO
        // $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_ar)),'')<>''"); 
        // $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_po)),'')<>''");
        // AP
        $query->andWhere("ISNULL(LTRIM(RTRIM(nomer_ap)),'')=''"); 

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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }

    // Document Pending / GL
    public function searchdocumentpending($params)
    {
        $query = ModelReferralNonMemberLog::find();
        $query->Where("ISNULL(LTRIM(RTRIM(no_gl)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(nama_rs)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(no_invoice)),'')=''");
        $query->orWhere("ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')=''");
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
            'tanggal_terima_berkas' => $this->tanggal_terima_berkas,
            'tanggal_periksa' => $this->tanggal_periksa,
            'jumlah' => $this->jumlah,
            'tanggal_input_link_document' => $this->tanggal_input_link_document,
            'tanggal_kirim_dokument_ar_ap' => $this->tanggal_kirim_dokument_ar_ap,
            'tanggal_so_pr' => $this->tanggal_so_pr,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_at_so' => $this->created_at_so,
            'update_at_so' => $this->update_at_so,
            'created_at_ar' => $this->created_at_ar,
            'update_at_ar' => $this->update_at_ar,
            'created_at_po' => $this->created_at_po,
            'update_at_po' => $this->update_at_po,
            'created_at_ap' => $this->created_at_ap,
            'update_at_ap' => $this->update_at_ap,
        ]);

        $query->andFilterWhere(['like', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_gl', $this->no_gl])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'jalur_pembuatan', $this->jalur_pembuatan])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'link_dokumen_invoice', $this->link_dokumen_invoice])
            ->andFilterWhere(['like', 'document_file', $this->document_file])
            ->andFilterWhere(['like', 'remarks_tim_billing', $this->remarks_tim_billing])
            ->andFilterWhere(['like', 'link_gl', $this->link_gl])
            ->andFilterWhere(['like', 'nomer_so', $this->nomer_so])
            ->andFilterWhere(['like', 'nomer_pr', $this->nomer_pr])
            ->andFilterWhere(['like', 'nomer_ar', $this->nomer_ar])
            ->andFilterWhere(['like', 'remarks_tim_ar', $this->remarks_tim_ar])
            ->andFilterWhere(['like', 'nomer_po', $this->nomer_po])
            ->andFilterWhere(['like', 'remarks_tim_procurement', $this->remarks_tim_procurement])
            ->andFilterWhere(['like', 'nomer_ap', $this->nomer_ap])
            ->andFilterWhere(['like', 'remark_tim_ap', $this->remark_tim_ap])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status_permasalahan', $this->status_permasalahan])
            ->andFilterWhere(['like', 'created_by_so', $this->created_by_so])
            ->andFilterWhere(['like', 'update_by_so', $this->update_by_so])
            ->andFilterWhere(['like', 'created_by_ar', $this->created_by_ar])
            ->andFilterWhere(['like', 'update_by_ar', $this->update_by_ar])
            ->andFilterWhere(['like', 'created_by_po', $this->created_by_po])
            ->andFilterWhere(['like', 'update_by_po', $this->update_by_po])
            ->andFilterWhere(['like', 'created_by_ap', $this->created_by_ap])
            ->andFilterWhere(['like', 'update_by_ap', $this->update_by_ap]);

        return $dataProvider;
    }




}
