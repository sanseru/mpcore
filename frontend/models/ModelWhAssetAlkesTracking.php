<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES_TRACKING".
 *
 * @property int $id
 * @property string|null $codeAsset
 * @property string|null $StatusBarang
 * @property string|null $noInvTrans
 * @property string|null $tgl_pengiriman
 * @property string|null $tgl_penerimaan
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelWhAssetAlkesTracking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES_TRACKING';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_pengiriman', 'tgl_penerimaan', 'createdTime','keterangan'], 'safe'],
            [['codeAsset', 'noInvTrans', 'createdBy'], 'string', 'max' => 50],
            [['StatusBarang'], 'string', 'max' => 150],
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
            'StatusBarang' => 'Status Barang',
            'noInvTrans' => 'No Inv Trans',
            'tgl_pengiriman' => 'Tgl Pengiriman',
            'tgl_penerimaan' => 'Tgl Penerimaan',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
