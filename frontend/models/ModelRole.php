<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $idrole
 * @property string $role_name
 * @property int $flag
 */
class ModelRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_name', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['role_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrole' => 'Idrole',
            'role_name' => 'Role Name',
            'flag' => 'Flag',
        ];
    }
}
