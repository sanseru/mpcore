<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "INV_STATUS".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $description
 */
class ModelInvStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'INV_STATUS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }
}
