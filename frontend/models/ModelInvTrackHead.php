<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "INV_TRACK_HEAD".
 *
 * @property string $id
 * @property string|null $noinvoice
 * @property string|null $perusahaan
 * @property int|null $status
 * @property string|null $created_by
 * @property string|null $created_time
 */
class ModelInvTrackHead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;

    public static function tableName()
    {
        return 'INV_TRACK_HEAD';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['status'], 'integer'],
            [['created_time','batching'], 'safe'],
            [['id'], 'string', 'max' => 10],
            [['noinvoice', 'created_by'], 'string', 'max' => 50],
            [['perusahaan'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['file'],'required'],
            [['file'],'file','extensions'=>'xlsx,xls','maxSize'=>1024 * 1024 * 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noinvoice' => 'Noinvoice',
            'perusahaan' => 'Perusahaan',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
        ];
    }
    public function getinvStatus(){
        return $this->hasOne(ModelInvStatus::className(), ['id' => 'status']);
    }
}
