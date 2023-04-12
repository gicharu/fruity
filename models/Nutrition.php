<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "nutrition".
 *
 * @property int $id
 * @property int|null $fruit_id
 * @property float|null $carbohydrates
 * @property float|null $protein
 * @property float|null $fat
 * @property float|null $calories
 * @property float|null $sugar
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Fruits $fruit
 */
class Nutrition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nutrition';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fruit_id'], 'integer'],
            [['carbohydrates', 'protein', 'fat', 'calories', 'sugar'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['fruit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fruits::class, 'targetAttribute' => ['fruit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fruit_id' => 'Fruit ID',
            'carbohydrates' => 'Carbohydrates',
            'protein' => 'Protein',
            'fat' => 'Fat',
            'calories' => 'Calories',
            'sugar' => 'Sugar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Fruit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFruit()
    {
        return $this->hasOne(Fruits::class, ['id' => 'fruit_id']);
    }
}
