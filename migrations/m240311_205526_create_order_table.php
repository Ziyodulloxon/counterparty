<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%counterparty}}`
 */
class m240311_205526_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'date_time' => $this->datetime()->notNull(),
            'counterparty_id' => $this->integer(),
            'amount' => $this->integer()->notNull(),
            'status' => $this->string(30)->notNull(),
        ]);

        // creates index for column `counterparty_id`
        $this->createIndex(
            '{{%idx-order-counterparty_id}}',
            '{{%order}}',
            'counterparty_id'
        );

        // add foreign key for table `{{%counterparty}}`
        $this->addForeignKey(
            '{{%fk-order-counterparty_id}}',
            '{{%order}}',
            'counterparty_id',
            '{{%counterparty}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%counterparty}}`
        $this->dropForeignKey(
            '{{%fk-order-counterparty_id}}',
            '{{%order}}'
        );

        // drops index for column `counterparty_id`
        $this->dropIndex(
            '{{%idx-order-counterparty_id}}',
            '{{%order}}'
        );

        $this->dropTable('{{%order}}');
    }
}
