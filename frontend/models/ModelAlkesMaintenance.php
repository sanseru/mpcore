<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES_MAINTENANCE".
 *
 * @property int $id
 * @property string|null $codeAsset
 * @property string|null $tgl_maintenance
 * @property string|null $jenis
 * @property string|null $teknisi
 * @property string|null $nolk
 * @property string|null $hasil
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelAlkesMaintenance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES_MAINTENANCE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_maintenance', 'createdTime'], 'safe'],
            [['codeAsset', 'jenis', 'teknisi', 'nolk', 'hasil', 'createdBy'], 'string', 'max' => 50],
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
            'tgl_maintenance' => 'Tgl Maintenance',
            'jenis' => 'Jenis',
            'teknisi' => 'Teknisi',
            'nolk' => 'Nolk',
            'hasil' => 'Hasil',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
