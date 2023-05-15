<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_STCKOP_HEAD".
 *
 * @property int $id
 * @property string|null $idStockOP
 * @property string|null $gudang
 * @property string|null $tanggal_mulai
 * @property string|null $keterangan
 * @property int|null $status
 * @property string|null $createdBy
 * @property string|null $createdTime
 * @property string|null $ModifiedBy
 * @property string|null $ModifiedTime
 */
class ModelWarehouseStockOPHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_STCKOP_HEAD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal_mulai', 'createdTime', 'ModifiedTime'], 'safe'],
            [['keterangan'], 'string'],
            [['status','gudang'], 'integer'],
            [['idStockOP'], 'string', 'max' => 50],
            [['gudang','keterangan','penanggungJawab'], 'required'],
            [['createdBy', 'ModifiedBy'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idStockOP' => 'Code',
            'gudang' => 'Gudang',
            'tanggal_mulai' => 'Tanggal Mulai',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
            'ModifiedBy' => 'Modified By',
            'ModifiedTime' => 'Modified Time',
        ];
    }
    public function getGudangWh(){
        return $this->hasOne(ModelWhgudang::className(), ['id' => 'gudang']);
    }
}
