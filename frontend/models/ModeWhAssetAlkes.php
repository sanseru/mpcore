<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES".
 *
 * @property int $id
 * @property string|null $codeAset
 * @property string|null $noAsset_SAP
 * @property string|null $noInventory
 * @property string|null $namaAlat
 * @property string|null $merk
 * @property string|null $tipe
 * @property string|null $noSeri
 * @property string|null $lokasi
 * @property string|null $tglBeli
 * @property string|null $tglKalibrasi
 * @property string|null $Supplier
 * @property string|null $kondisi
 * @property string|null $createdBy
 * @property string|null $createdTime
 * @property string|null $modifiedBy
 * @property string|null $modifiedTime
 */
class ModeWhAssetAlkes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tglBeli', 'tglKalibrasi', 'createdTime', 'modifiedTime','tglexpKalibrasi'], 'safe'],
            [['codeAset', 'createdBy', 'modifiedBy'], 'string', 'max' => 15],
            [['noAsset_SAP', 'noInventory', 'namaAlat', 'merk', 'tipe', 'noSeri', 'lokasi', 'kondisi'], 'string', 'max' => 50],
            [['Supplier'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codeAset' => 'Code Aset',
            'noAsset_SAP' => 'No Asset Sap',
            'noInventory' => 'No Inventory',
            'namaAlat' => 'Nama Alat',
            'merk' => 'Merk',
            'tipe' => 'Tipe',
            'noSeri' => 'No Seri',
            'lokasi' => 'Lokasi',
            'tglBeli' => 'Tanggal Beli',
            'tglKalibrasi' => 'Tanggal Kalibrasi',
            'Supplier' => 'Supplier',
            'kondisi' => 'Kondisi',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
            'modifiedBy' => 'Modified By',
            'modifiedTime' => 'Modified Time',
            'tglexpKalibrasi' => 'Habis Masa Kalibrasi',

        ];
    }
}
