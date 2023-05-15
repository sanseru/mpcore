<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "MAS_HELP_GL".
 *
 * @property string $id_gl
 * @property string $no_gl
 * @property int $provider_id
 * @property string $provider_name
 * @property string $up
 * @property string $alamat
 * @property int $case_category_id
 * @property int|null $member_id
 * @property string $first_name
 * @property string $sex
 * @property string $customer_number
 * @property string $group_name
 * @property int|null $relationship_id
 * @property string $relationship_name
 * @property string $parent_name
 * @property string $tanggal_rawat
 * @property string $tanggal_gl
 * @property string $tgl_lahir
 * @property string|null $diagnosis_id
 * @property string|null $diagnosis_name
 * @property string|null $diagnosis_id2
 * @property string|null $diagnosis_name2
 * @property string $diagnosis_dokter
 * @property string|null $medical_record
 * @property int|null $id_dokter
 * @property string $nama_dokter
 * @property string|null $pic
 * @property string $kelas_kamar_rawat
 * @property string|null $email
 * @property int|null $id_template_gl
 * @property int|null $type_gl
 * @property float|null $billing_akhir
 * @property string|null $id_transaksi_case_monitoring
 * @property int|null $status_kegawatan
 * @property string|null $remark
 * @property string|null $username
 * @property string|null $tanggal_input
 * @property int $deleted_status
 * @property int|null $modified_time
 * @property string|null $modified_by
 * @property string|null $deleted_by
 * @property int|null $deleted_time
 * @property string $created_time
 * @property string $created_by
 * @property int|null $is_member
 * @property int $urutan
 * @property float|null $actual_amount
 * @property float|null $cover_amount
 * @property float|null $excess_amount
 * @property string|null $excess_remark
 * @property int|null $gl_type
 * @property string|null $tanggal_selesai
 * @property string|null $diagnosis_dokter2
 * @property string|null $final_time
 * @property string|null $final_by
 * @property string|null $no_so
 * @property string|null $no_ap
 * @property int|null $diterima
 * @property string|null $received_remark
 * @property string|null $received_date
 * @property string|null $email_pasien
 * @property string|null $caseglnumber
 */
class ModelMasHelpGlMas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MAS_HELP_GL';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gl', 'no_gl', 'provider_id', 'provider_name', 'up', 'alamat', 'case_category_id', 'first_name', 'sex', 'customer_number', 'group_name', 'relationship_name', 'parent_name', 'tanggal_rawat', 'tanggal_gl', 'tgl_lahir', 'diagnosis_dokter', 'nama_dokter', 'kelas_kamar_rawat', 'deleted_status', 'created_time', 'created_by'], 'required'],
            [['provider_id', 'case_category_id', 'member_id', 'relationship_id', 'id_dokter', 'id_template_gl', 'type_gl', 'status_kegawatan', 'deleted_status', 'modified_time', 'deleted_time', 'is_member', 'gl_type', 'diterima'], 'integer'],
            [['tanggal_rawat', 'tanggal_gl', 'tgl_lahir', 'tanggal_input', 'created_time', 'tanggal_selesai', 'final_time', 'received_date'], 'safe'],
            [['billing_akhir', 'actual_amount', 'cover_amount', 'excess_amount'], 'number'],
            [['remark', 'excess_remark', 'received_remark'], 'string'],
            [['id_gl'], 'string', 'max' => 22],
            [['no_gl'], 'string', 'max' => 26],
            [['provider_name', 'up', 'first_name', 'group_name', 'parent_name', 'nama_dokter', 'pic', 'email'], 'string', 'max' => 100],
            [['alamat', 'relationship_name', 'diagnosis_name', 'diagnosis_name2', 'diagnosis_dokter', 'kelas_kamar_rawat', 'modified_by', 'deleted_by', 'created_by', 'diagnosis_dokter2'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 20],
            [['customer_number', 'username', 'final_by', 'no_so', 'no_ap'], 'string', 'max' => 50],
            [['diagnosis_id', 'diagnosis_id2'], 'string', 'max' => 11],
            [['medical_record'], 'string', 'max' => 250],
            [['id_transaksi_case_monitoring'], 'string', 'max' => 19],
            [['email_pasien'], 'string', 'max' => 150],
            [['caseglnumber'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_gl' => 'Id Gl',
            'no_gl' => 'No Gl',
            'provider_id' => 'Provider ID',
            'provider_name' => 'Provider Name',
            'up' => 'Up',
            'alamat' => 'Alamat',
            'case_category_id' => 'Case Category ID',
            'member_id' => 'Member ID',
            'first_name' => 'First Name',
            'sex' => 'Sex',
            'customer_number' => 'Customer Number',
            'group_name' => 'Group Name',
            'relationship_id' => 'Relationship ID',
            'relationship_name' => 'Relationship Name',
            'parent_name' => 'Parent Name',
            'tanggal_rawat' => 'Tanggal Rawat',
            'tanggal_gl' => 'Tanggal Gl',
            'tgl_lahir' => 'Tgl Lahir',
            'diagnosis_id' => 'Diagnosis ID',
            'diagnosis_name' => 'Diagnosis Name',
            'diagnosis_id2' => 'Diagnosis Id2',
            'diagnosis_name2' => 'Diagnosis Name2',
            'diagnosis_dokter' => 'Diagnosis Dokter',
            'medical_record' => 'Medical Record',
            'id_dokter' => 'Id Dokter',
            'nama_dokter' => 'Nama Dokter',
            'pic' => 'Pic',
            'kelas_kamar_rawat' => 'Kelas Kamar Rawat',
            'email' => 'Email',
            'id_template_gl' => 'Id Template Gl',
            'type_gl' => 'Type Gl',
            'billing_akhir' => 'Billing Akhir',
            'id_transaksi_case_monitoring' => 'Id Transaksi Case Monitoring',
            'status_kegawatan' => 'Status Kegawatan',
            'remark' => 'Remark',
            'username' => 'Username',
            'tanggal_input' => 'Tanggal Input',
            'deleted_status' => 'Deleted Status',
            'modified_time' => 'Modified Time',
            'modified_by' => 'Modified By',
            'deleted_by' => 'Deleted By',
            'deleted_time' => 'Deleted Time',
            'created_time' => 'Created Time',
            'created_by' => 'Created By',
            'is_member' => 'Is Member',
            'urutan' => 'Urutan',
            'actual_amount' => 'Actual Amount',
            'cover_amount' => 'Cover Amount',
            'excess_amount' => 'Excess Amount',
            'excess_remark' => 'Excess Remark',
            'gl_type' => 'Gl Type',
            'tanggal_selesai' => 'Tanggal Selesai',
            'diagnosis_dokter2' => 'Diagnosis Dokter2',
            'final_time' => 'Final Time',
            'final_by' => 'Final By',
            'no_so' => 'No So',
            'no_ap' => 'No Ap',
            'diterima' => 'Diterima',
            'received_remark' => 'Received Remark',
            'received_date' => 'Received Date',
            'email_pasien' => 'Email Pasien',
            'caseglnumber' => 'Caseglnumber',
        ];
    }
}
