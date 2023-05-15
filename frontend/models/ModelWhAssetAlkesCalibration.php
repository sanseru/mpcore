<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES_CALIBRATION".
 *
 * @property int $id
 * @property string|null $codeAsset
 * @property string|null $tgl_kalibrasi
 * @property string|null $tgl_endkalibrasi
 * @property string|null $institusi
 * @property string|null $nosertifikat
 * @property string|null $hasil
 * @property string|null $filesertifikat
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelWhAssetAlkesCalibration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES_CALIBRATION';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_kalibrasi', 'tgl_endkalibrasi', 'createdTime'], 'safe'],
            [['filesertifikat'], 'string'],
            [['codeAsset', 'nosertifikat', 'hasil', 'createdBy'], 'string', 'max' => 50],
            [['institusi'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codeAsset' => 'Code Asset',
            'tgl_kalibrasi' => 'Tgl Kalibrasi',
            'tgl_endkalibrasi' => 'Tgl Endkalibrasi',
            'institusi' => 'Institusi',
            'nosertifikat' => 'Nosertifikat',
            'hasil' => 'Hasil',
            'filesertifikat' => 'Filesertifikat',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
