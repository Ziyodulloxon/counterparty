<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_counterparty}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%counterparty}}`
 */
class m240311_215148_create_price_counterparty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price_counterparty}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(10),
            'price_date' => $this->date(),
            'price' => $this->integer(),
            'counterparty_id' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-price_counterparty-product_id}}',
            '{{%price_counterparty}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-price_counterparty-product_id}}',
            '{{%price_counterparty}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `counterparty_id`
        $this->createIndex(
            '{{%idx-price_counterparty-counterparty_id}}',
            '{{%price_counterparty}}',
            'counterparty_id'
        );

        // add foreign key for table `{{%counterparty}}`
        $this->addForeignKey(
            '{{%fk-price_counterparty-counterparty_id}}',
            '{{%price_counterparty}}',
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
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-price_counterparty-product_id}}',
            '{{%price_counterparty}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-price_counterparty-product_id}}',
            '{{%price_counterparty}}'
        );

        // drops foreign key for table `{{%counterparty}}`
        $this->dropForeignKey(
            '{{%fk-price_counterparty-counterparty_id}}',
            '{{%price_counterparty}}'
        );

        // drops index for column `counterparty_id`
        $this->dropIndex(
            '{{%idx-price_counterparty-counterparty_id}}',
            '{{%price_counterparty}}'
        );

        $this->dropTable('{{%price_counterparty}}');
    }
}
