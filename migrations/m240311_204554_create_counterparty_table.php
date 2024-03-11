<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%counterparty}}`.
 */
class m240311_204554_create_counterparty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%counterparty}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'created_at' => $this->integer(10),
            'updated_at' => $this->integer(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%counterparty}}');
    }
}
