<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $idmenu
 * @property string $nama_menu
 * @property string $link
 * @property int $flag
 * @property string|null $icon
 */
class ModelMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_menu', 'link', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['nama_menu', 'link'], 'string', 'max' => 100],
            [['icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmenu' => 'Idmenu',
            'nama_menu' => 'Nama Menu',
            'link' => 'Link',
            'flag' => 'Flag',
            'icon' => 'Icon',
        ];
    }
}
