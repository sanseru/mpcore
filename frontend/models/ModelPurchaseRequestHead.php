<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "PR_HEAD".
 *
 * @property int $id
 * @property string|null $requester_name
 * @property int|null $branch_id
 * @property int|null $department_id
 * @property string|null $nopr
 * @property string|null $status
 * @property string|null $posting_date
 * @property string|null $required_date
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string|null $update_at
 * @property string|null $update_by
 * @property string|null $description
 * @property string|null $valid_until
 * @property string|null $document_date
 */
class ModelPurchaseRequestHead extends \yii\db\ActiveRecord
{
    // public $test;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PR_HEAD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'branch_id', 'department_id'], 'integer'],
            [['posting_date', 'required_date', 'created_at', 'update_at', 'valid_until', 'document_date'], 'safe'],
            [['description'], 'string'],
            [['requester_name', 'nopr', 'status', 'created_by', 'update_by'], 'string', 'max' => 50],
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
            'requester_name' => 'Requester Name',
            'branch_id' => 'Branch ID',
            'department_id' => 'Department ID',
            'nopr' => 'Nopr',
            'status' => 'Status',
            'posting_date' => 'Posting Date',
            'required_date' => 'Required Date',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
            'update_by' => 'Update By',
            'description' => 'Description',
            'valid_until' => 'Valid Until',
            'document_date' => 'Document Date',
        ];
    }
}
