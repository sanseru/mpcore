<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "OFFICE_LOCATION".
 *
 * @property int $id
 * @property string|null $office
 */
class ModelOfficeLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OFFICE_LOCATION';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['office'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'office' => 'Office',
        ];
    }
}
