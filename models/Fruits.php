<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "fruits".
 *
 * @property int $id
 * @property string $name
 * @property string $genus
 * @property string $family
 * @property string $order
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Nutrition[] $nutritions
 */
class Fruits extends \yii\db\ActiveRecord
{

    const CONSOLE_LOAD = 'console';

    public function behaviors()
    {
       return [
           TimestampBehavior::class
       ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fruits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'integer', 'on' => self::CONSOLE_LOAD],
            [['name', 'genus', 'family', 'order'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'genus', 'family', 'order'], 'string', 'max' => 50],
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
            'genus' => 'Genus',
            'family' => 'Family',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Nutritions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNutritions()
    {
        return $this->hasOne(Nutrition::class, ['fruit_id' => 'id']);
    }
}
