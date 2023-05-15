<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "MAS_PROVIDER_REBATE".
 *
 * @property int $id
 * @property string|null $providerName
 * @property int|null $providerId
 * @property float|null $rebate
 */
class ModelMasProviderRebate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MAS_PROVIDER_REBATE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['providerId','isdetail'], 'integer'],
            [['rebate'], 'number'],
            [['providerName'], 'string', 'max' => 250],
            [['isdetail'],'required'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'providerName' => 'Provider Name',
            'providerId' => 'Provider ID',
            'rebate' => 'Rebate',
            'isdetail' => 'Detail Rebate',

        ];
    }
}
