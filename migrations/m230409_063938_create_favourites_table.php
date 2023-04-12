<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favourites}}`.
 */
class m230409_063938_create_favourites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favourites}}', [
            'id' => $this->primaryKey(),
            'fav_fruits' => $this->json()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favourites}}');
    }
}
