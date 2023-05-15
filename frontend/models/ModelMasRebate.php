<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "MAS_REBATE".
 *
 * @property int $id
 * @property string|null $batchNumber
 * @property string|null $claimNumber
 * @property string|null $InvoiceNumber
 * @property string|null $receiveDate
 * @property string|null $admissionDate
 * @property string|null $dischargeDate
 * @property string|null $member
 * @property string|null $cardNumber
 * @property string|null $employeeName
 * @property string|null $relasi
 * @property string|null $idCustomer
 * @property string|null $department
 * @property string|null $providerName
 * @property string|null $bank
 * @property string|null $cabang
 * @property string|null $rekening
 * @property string|null $atasNama
 * @property string|null $email
 * @property string|null $dx
 * @property string|null $dxDescription
 * @property string|null $dx2
 * @property string|null $dx2Description
 * @property string|null $dx3
 * @property string|null $dx3Description
 * @property string|null $type
 * @property string|null $services
 * @property string|null $remarks
 * @property string|null $status
 * @property float|null $charge
 * @property float|null $approved
 * @property float|null $bayarDimuka
 * @property float|null $excess
 * @property string|null $userMas
 * @property string|null $dueDate
 * @property string|null $perusahaan
 * @property string|null $gender
 * @property string|null $birthday
 * @property string|null $jobPosition
 * @property string|null $dateCheked
 * @property string|null $dateApproved
 * @property string|null $datePaid
 * @property string|null $codeUpload
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelMasRebate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MAS_REBATE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receiveDate', 'admissionDate', 'dischargeDate', 'dueDate', 'birthday', 'dateCheked', 'dateApproved', 'datePaid', 'createdTime'], 'safe'],
            [['email', 'dxDescription', 'dx2Description', 'dx3Description', 'remarks'], 'string'],
            [['charge', 'approved', 'bayarDimuka', 'excess'], 'number'],
            [['batchNumber'], 'string', 'max' => 60],
            [['claimNumber', 'cardNumber', 'jobPosition'], 'string', 'max' => 50],
            [['InvoiceNumber','cabang'], 'string', 'max' => 250],
            [['member', 'employeeName'], 'string', 'max' => 80],
            [['relasi'], 'string', 'max' => 10],
            [['idCustomer'], 'string', 'max' => 20],
            [['department', 'atasNama', 'perusahaan'], 'string', 'max' => 150],
            [['providerName'], 'string', 'max' => 180],
            [['bank'], 'string', 'max' => 45],
            [['rekening', 'userMas', 'createdBy'], 'string', 'max' => 30],
            [['dx', 'dx2', 'dx3'], 'string', 'max' => 6],
            [['type'], 'string', 'max' => 4],
            [['services'], 'string', 'max' => 22],
            [['status'], 'string', 'max' => 15],
            [['gender'], 'string', 'max' => 2],
            [['codeUpload'], 'string', 'max' => 27],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batchNumber' => 'Batch Number',
            'claimNumber' => 'Claim Number',
            'InvoiceNumber' => 'Invoice Number',
            'receiveDate' => 'Receive Date',
            'admissionDate' => 'Admission Date',
            'dischargeDate' => 'Discharge Date',
            'member' => 'Member',
            'cardNumber' => 'Card Number',
            'employeeName' => 'Employee Name',
            'relasi' => 'Relasi',
            'idCustomer' => 'Id Customer',
            'department' => 'Department',
            'providerName' => 'Provider Name',
            'bank' => 'Bank',
            'cabang' => 'Cabang',
            'rekening' => 'Rekening',
            'atasNama' => 'Atas Nama',
            'email' => 'Email',
            'dx' => 'Dx',
            'dxDescription' => 'Dx Description',
            'dx2' => 'Dx2',
            'dx2Description' => 'Dx2 Description',
            'dx3' => 'Dx3',
            'dx3Description' => 'Dx3 Description',
            'type' => 'Type',
            'services' => 'Services',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'charge' => 'Charge',
            'approved' => 'Approved',
            'bayarDimuka' => 'Bayar Dimuka',
            'excess' => 'Excess',
            'userMas' => 'User Mas',
            'dueDate' => 'Due Date',
            'perusahaan' => 'Perusahaan',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'jobPosition' => 'Job Position',
            'dateCheked' => 'Date Cheked',
            'dateApproved' => 'Date Approved',
            'datePaid' => 'Date Paid',
            'codeUpload' => 'Code Upload',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
