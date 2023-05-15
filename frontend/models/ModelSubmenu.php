<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "submenu".
 *
 * @property int $idchild
 * @property int $parent_id
 * @property string $nama_menu
 * @property string $link
 * @property int $flag
 */
class ModelSubmenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'nama_menu', 'link', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['nama_menu', 'link'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idchild' => 'Idchild',
            'parent_id' => 'Parent ID',
            'nama_menu' => 'Nama Menu',
            'link' => 'Link',
            'flag' => 'Flag',
        ];
    }
}
