<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_STCKOP_DETAIL".
 *
 * @property int|null $id
 * @property string|null $itemcode
 * @property string|null $itemname
 * @property string|null $satuan
 * @property string|null $satuanCode
 * @property int|null $stockInSAP
 * @property int|null $stockReal
 * @property int|null $selisih
 * @property string|null $createdBy
 * @property string|null $createdTime
 */
class ModelWarehouseStockOPDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_STCKOP_DETAIL';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stockInSAP', 'stockReal', 'selisih'], 'integer'],
            [['createdTime','expiredate'], 'safe'],
            [['itemcode'], 'string', 'max' => 10],
            [['itemname'], 'string', 'max' => 255],
            [['satuan'], 'string', 'max' => 25],
            [['satuanCode'], 'string', 'max' => 50],
            [['createdBy'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemcode' => 'Itemcode',
            'itemname' => 'Itemname',
            'satuan' => 'Satuan',
            'satuanCode' => 'Satuan Code',
            'stockInSAP' => 'Stock In Sap',
            'stockReal' => 'Stock Real',
            'selisih' => 'Selisih',
            'createdBy' => 'Created By',
            'createdTime' => 'Created Time',
        ];
    }
}
