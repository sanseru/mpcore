<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "KURIR_DETAIL".
 *
 * @property int $id
 * @property int|null $head_id
 * @property int|null $status
 * @property string|null $username
 * @property string|null $remarks
 * @property string|null $photo
 * @property string|null $createdtime
 * @property string|null $createdby
 */
class ModelKurirDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'KURIR_DETAIL';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'head_id', 'status'], 'integer'],
            [['remarks'], 'string'],
            [['createdtime'], 'safe'],
            [['username', 'createdby'], 'string', 'max' => 150],
            [['photo'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'head_id' => 'Head ID',
            'status' => 'Status',
            'username' => 'Username',
            'remarks' => 'Remarks',
            'photo' => 'Photo',
            'createdtime' => 'Createdtime',
            'createdby' => 'Createdby',
        ];
    }
}
