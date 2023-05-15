<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "KURIR_STATUS".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $descryption
 */
class ModelKurirStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'KURIR_STATUS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descryption'], 'string'],
            [['status'], 'string', 'max' => 150],
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
            'descryption' => 'Descryption',
        ];
    }
}
