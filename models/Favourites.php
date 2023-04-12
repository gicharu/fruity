<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favourites".
 *
 * @property int $id
 * @property string|null $fav_fruits
 */
class Favourites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favourites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fav_fruits'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fav_fruits' => 'Fav Fruits',
        ];
    }
}
