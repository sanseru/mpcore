<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES_REPAIR".
 *
 * @property int $id
 * @property string|null $codeAsset
 * @property string|null $tgl_repair
 * @property string|null $keluhan
 * @property string|null $teknisi
 * @property string|null $hasil
 * @property string|null $sparepart
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelWhAssetAlkesRepair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES_REPAIR';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_repair', 'createdTime'], 'safe'],
            [['sparepart'], 'string'],
            [['codeAsset', 'createdBy'], 'string', 'max' => 50],
            [['keluhan', 'teknisi', 'hasil'], 'string', 'max' => 150],
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
            'tgl_repair' => 'Tgl Repair',
            'keluhan' => 'Keluhan',
            'teknisi' => 'Teknisi',
            'hasil' => 'Hasil',
            'sparepart' => 'Sparepart',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
