<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_ASSET_ALKES_ACESSORIES".
 *
 * @property int $id
 * @property string|null $codeAsset
 * @property string|null $acessories
 * @property string|null $keterangan
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelWhAssetAlkesAcessories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_ASSET_ALKES_ACESSORIES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acessories', 'keterangan'], 'string'],
            [['createdTime'], 'safe'],
            [['codeAsset', 'createdBy'], 'string', 'max' => 50],
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
            'acessories' => 'Acessories',
            'keterangan' => 'Keterangan',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
