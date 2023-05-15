<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "KURIR_HEAD".
 *
 * @property int $id
 * @property string|null $penerima
 * @property string|null $nopenerima
 * @property string|null $namabarang
 * @property string|null $alamat
 * @property string|null $pengirim
 * @property string|null $nopengirim
 * @property string|null $mendesak
 * @property int|null $status
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $onprocess_time
 * @property string|null $onprocess_by
 * @property string|null $reschedule_time
 * @property string|null $reschedule_by
 * @property string|null $delivered_time
 * @property string|null $delivered_by
 * @property string|null $recipient
 * @property string|null $ttdrecipient
 * @property string|null $cancel_time
 * @property string|null $cancel_by
 * @property string|null $cancelRemarks
 */
class ModelKurirHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'KURIR_HEAD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status'], 'integer'],
            [['alamat', 'ttdrecipient', 'cancelRemarks','catatan'], 'string'],
            [['created_at', 'onprocess_time', 'reschedule_time', 'delivered_time', 'resiback_time' , 'cancel_time','update_at','update_by','kurirnya'], 'safe'],
            [['penerima', 'namabarang','resiback'], 'string', 'max' => 250],
            [['nopenerima', 'nopengirim', 'mendesak'], 'string', 'max' => 50],
            [['pengirim', 'created_by', 'onprocess_by', 'reschedule_by', 'delivered_by', 'recipient', 'cancel_by','namapic'], 'string', 'max' => 150],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penerima' => 'Penerima',
            'nopenerima' => 'Nopenerima',
            'namabarang' => 'Namabarang',
            'alamat' => 'Alamat',
            'pengirim' => 'Pengirim',
            'nopengirim' => 'Nopengirim',
            'mendesak' => 'Mendesak',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'onprocess_time' => 'Onprocess Time',
            'onprocess_by' => 'Onprocess By',
            'reschedule_time' => 'Reschedule Time',
            'reschedule_by' => 'Reschedule By',
            'delivered_time' => 'Delivered Time',
            'delivered_by' => 'Delivered By',
            'recipient' => 'Recipient',
            'ttdrecipient' => 'Ttdrecipient',
            'cancel_time' => 'Cancel Time',
            'cancel_by' => 'Cancel By',
            'cancelRemarks' => 'Cancel Remarks',
        ];
    }
}
