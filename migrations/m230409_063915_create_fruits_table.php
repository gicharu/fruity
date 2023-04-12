<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fruits}}`.
 */
class m230409_063915_create_fruits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fruits}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'genus' => $this->string(50)->notNull(),
            'family' => $this->string(50)->notNull(),
            'order' => $this->string(50)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fruits}}');
    }
}
