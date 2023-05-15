<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Serahterimaasset".
 *
 * @property int $id
 * @property string|null $User_Name
 * @property string|null $Host_Name
 * @property string|null $Manufacturer
 * @property string|null $Services_Tag
 * @property string|null $Vesion_Product
 * @property string|null $Status_Aset
 * @property string|null $Project
 * @property string|null $Location
 * @property string|null $Addon_Item
 * @property string|null $Date_Asset
 * @property string|null $Created_Time
 * @property string|null $Created_By
 */
class ModelSerahterimaasset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Serahterimaasset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Addon_Item'], 'string'],
            [['Date_Asset', 'Created_Time','ModifiedDatetime','namaFile','UploadTime','ModifiedBy'], 'safe'],
            [['User_Name', 'Host_Name', 'Manufacturer', 'Services_Tag', 'Vesion_Product', 'Status_Aset', 'Location', 'Created_By'], 'string', 'max' => 50],
            [['Project'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'User_Name' => 'User Name',
            'Host_Name' => 'Host Name',
            'Manufacturer' => 'Manufacturer',
            'Services_Tag' => 'Services Tag',
            'Vesion_Product' => 'Vesion Product',
            'Status_Aset' => 'Status Aset',
            'Project' => 'Project',
            'Location' => 'Location',
            'Addon_Item' => 'Addon Item',
            'Date_Asset' => 'Date Asset',
            'Created_Time' => 'Created Time',
            'Created_By' => 'Created By',
        ];
    }
}
