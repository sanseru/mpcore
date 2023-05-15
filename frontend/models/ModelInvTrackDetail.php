<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "INV_TRACK_DETAIL".
 *
 * @property int $id
 * @property int|null $no_invoice
 * @property int|null $status
 * @property string|null $name
 * @property string|null $description
 * @property string|null $createdTime
 * @property string|null $createdBy
 */
class ModelInvTrackDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'INV_TRACK_DETAIL';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_invoice', 'status'], 'integer'],
            [['description'], 'string'],
            [['createdTime','photo'], 'safe'],
            [['name', 'createdBy'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_invoice' => 'No Invoice',
            'status' => 'Status',
            'name' => 'Name',
            'description' => 'Description',
            'createdTime' => 'Created Time',
            'createdBy' => 'Created By',
        ];
    }
}
