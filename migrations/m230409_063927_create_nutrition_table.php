<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nutrition}}`.
 */
class m230409_063927_create_nutrition_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nutrition}}', [
            'id' => $this->primaryKey(),
            'fruit_id' => $this->integer(11),
            'carbohydrates' => $this->float(1),
            'protein' => $this->float(1),
            'fat' => $this->float(1),
            'calories' => $this->float(1),
            'sugar' => $this->float(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk_fruits_fruit_id', 'nutrition', 'fruit_id', 'fruits', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_fruits_fruit_id', 'nutrition');
        $this->dropTable('{{%nutrition}}');
    }
}
