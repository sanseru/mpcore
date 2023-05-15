<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "DEPARTMENT".
 *
 * @property int $id
 * @property string|null $department
 */
class ModelDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DEPARTMENT';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
        ];
    }
}
