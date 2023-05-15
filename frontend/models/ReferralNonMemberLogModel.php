<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "referral_non_member_log".
 *
 * @property int $id
 * @property string|null $tanggal_terima_berkas
 * @property string|null $tanggal_periksa
 * @property string|null $nama_rs
 * @property string|null $no_invoice
 * @property string|null $no_gl
 * @property string|null $nama_peserta
 * @property string|null $jalur_pembuatan
 * @property float|null $jumlah
 * @property string|null $client
 * @property string|null $link_dokumen_invoice
 * @property string|null $document_file
 * @property string|null $tanggal_input_link_document
 * @property string|null $tanggal_kirim_dokument_ar_ap
 * @property string|null $remarks_tim_billing
 * @property string|null $link_gl
 * @property string|null $nomer_so
 * @property string|null $nomer_pr
 * @property string|null $tanggal_so_pr
 * @property string|null $nomer_ar
 * @property string|null $remarks_tim_ar
 * @property string|null $nomer_po
 * @property string|null $remarks_tim_procurement
 * @property string|null $nomer_ap
 * @property string|null $remark_tim_ap
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $update_at
 * @property string|null $Update_by
 * @property string|null $status_permasalahan
 * @property string|null $created_at_so
 * @property string|null $created_by_so
 * @property string|null $update_at_so
 * @property string|null $update_by_so
 * @property string|null $created_at_ar
 * @property string|null $created_by_ar
 * @property string|null $update_at_ar
 * @property string|null $update_by_ar
 * @property string|null $created_at_po
 * @property string|null $created_by_po
 * @property string|null $update_at_po
 * @property string|null $update_by_po
 * @property string|null $created_at_ap
 * @property string|null $created_by_ap
 * @property string|null $update_at_ap
 * @property string|null $update_by_ap
 */
class ReferralNonMemberLogModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referral_non_member_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal_terima_berkas', 'tanggal_periksa', 'tanggal_input_link_document', 'tanggal_kirim_dokument_ar_ap', 'tanggal_so_pr', 'created_at', 'update_at', 'created_at_so', 'update_at_so', 'created_at_ar', 'update_at_ar', 'created_at_po', 'update_at_po', 'created_at_ap', 'update_at_ap'], 'safe'],
            [['jumlah'], 'number'],
            [['link_dokumen_invoice', 'document_file', 'remarks_tim_billing', 'link_gl', 'remarks_tim_ar', 'remarks_tim_procurement', 'remark_tim_ap'], 'string'],
            [['nama_rs'], 'string', 'max' => 255],
            [['no_invoice', 'nama_peserta', 'jalur_pembuatan', 'client', 'nomer_so', 'nomer_pr', 'nomer_ar', 'nomer_po', 'nomer_ap', 'created_by', 'Update_by'], 'string', 'max' => 150],
            [['no_gl', 'status_permasalahan', 'created_by_so', 'update_by_so', 'created_by_ar', 'update_by_ar', 'created_by_po', 'update_by_po', 'created_by_ap', 'update_by_ap'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal_terima_berkas' => 'Tanggal Terima Berkas',
            'tanggal_periksa' => 'Tanggal Periksa',
            'nama_rs' => 'Nama Rs',
            'no_invoice' => 'No Invoice',
            'no_gl' => 'No Gl',
            'nama_peserta' => 'Nama Peserta',
            'jalur_pembuatan' => 'Jalur Pembuatan',
            'jumlah' => 'Jumlah',
            'client' => 'Client',
            'link_dokumen_invoice' => 'Link Dokumen Invoice',
            'document_file' => 'Document File',
            'tanggal_input_link_document' => 'Tanggal Input Link Document',
            'tanggal_kirim_dokument_ar_ap' => 'Tanggal Kirim Dokument Ar Ap',
            'remarks_tim_billing' => 'Remarks Tim Billing',
            'link_gl' => 'Link Gl',
            'nomer_so' => 'Nomer So',
            'nomer_pr' => 'Nomer Pr',
            'tanggal_so_pr' => 'Tanggal So Pr',
            'nomer_ar' => 'Nomer Ar',
            'remarks_tim_ar' => 'Remarks Tim Ar',
            'nomer_po' => 'Nomer Po',
            'remarks_tim_procurement' => 'Remarks Tim Procurement',
            'nomer_ap' => 'Nomer Ap',
            'remark_tim_ap' => 'Remark Tim Ap',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'update_at' => 'Update At',
            'Update_by' => 'Update By',
            'status_permasalahan' => 'Status Permasalahan',
            'created_at_so' => 'Created At So',
            'created_by_so' => 'Created By So',
            'update_at_so' => 'Update At So',
            'update_by_so' => 'Update By So',
            'created_at_ar' => 'Created At Ar',
            'created_by_ar' => 'Created By Ar',
            'update_at_ar' => 'Update At Ar',
            'update_by_ar' => 'Update By Ar',
            'created_at_po' => 'Created At Po',
            'created_by_po' => 'Created By Po',
            'update_at_po' => 'Update At Po',
            'update_by_po' => 'Update By Po',
            'created_at_ap' => 'Created At Ap',
            'created_by_ap' => 'Created By Ap',
            'update_at_ap' => 'Update At Ap',
            'update_by_ap' => 'Update By Ap',
        ];
    }
}
