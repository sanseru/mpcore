<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "REFERRAL_TRANSMISSION".
 *
 * @property int $id
 * @property int|null $idreferral
 * @property string|null $description
 * @property string|null $remainderdate
 * @property int|null $status
 * @property string|null $created_by
 * @property string|null $created_at
 */
class ModelReferralTransmission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'REFERRAL_TRANSMISSION';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idreferral', 'status'], 'integer'],
            [['description'], 'string'],
            [['status','assign_to'],'required'],
            [['remainderdate', 'created_at'], 'safe'],
            [['created_by'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idreferral' => 'Idreferral',
            'description' => 'Description',
            'remainderdate' => 'Remainderdate',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'assign_to' => 'Assign To',
        ];
    }
}
