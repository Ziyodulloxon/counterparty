<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%counterparty}}`
 */
class m240311_204739_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(10),
            'price_date' => $this->date(),
            'price' => $this->integer(),
            'counterparty_id' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-price-product_id}}',
            '{{%price}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-price-product_id}}',
            '{{%price}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `counterparty_id`
        $this->createIndex(
            '{{%idx-price-counterparty_id}}',
            '{{%price}}',
            'counterparty_id'
        );

        // add foreign key for table `{{%counterparty}}`
        $this->addForeignKey(
            '{{%fk-price-counterparty_id}}',
            '{{%price}}',
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
            '{{%fk-price-product_id}}',
            '{{%price}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-price-product_id}}',
            '{{%price}}'
        );

        // drops foreign key for table `{{%counterparty}}`
        $this->dropForeignKey(
            '{{%fk-price-counterparty_id}}',
            '{{%price}}'
        );

        // drops index for column `counterparty_id`
        $this->dropIndex(
            '{{%idx-price-counterparty_id}}',
            '{{%price}}'
        );

        $this->dropTable('{{%price}}');
    }
}
