<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "menuakses".
 *
 * @property int $idrole
 * @property string $description
 * @property string $menu_name
 * @property int $flag
 * @property int $urutan
 */
class ModelMenuakses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menuakses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrole', 'description', 'menu_name', 'flag'], 'required'],
            [['idrole', 'flag'], 'integer'],
            [['description', 'menu_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrole' => 'Idrole',
            'description' => 'Description',
            'menu_name' => 'Menu Name',
            'flag' => 'Flag',
            'urutan' => 'Urutan',
        ];
    }
}
