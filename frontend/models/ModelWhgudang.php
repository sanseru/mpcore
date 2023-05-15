<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "WH_GUDANG".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $keterangan
 */
class ModelWhgudang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WH_GUDANG';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['keterangan'], 'string'],
            [['name'], 'string', 'max' => 50],
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
            'name' => 'Name',
            'keterangan' => 'Keterangan',
        ];
    }
}
