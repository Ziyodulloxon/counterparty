<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%order}}`
 * - `{{%product}}`
 */
class m240311_215458_create_order_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_product}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(),
            'price' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_product-order_id}}',
            '{{%order_product}}',
            'order_id'
        );

        // add foreign key for table `{{%order}}`
        $this->addForeignKey(
            '{{%fk-order_product-order_id}}',
            '{{%order_product}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-order_product-product_id}}',
            '{{%order_product}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-order_product-product_id}}',
            '{{%order_product}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-order_product-order_id}}',
            '{{%order_product}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_product-order_id}}',
            '{{%order_product}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-order_product-product_id}}',
            '{{%order_product}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-order_product-product_id}}',
            '{{%order_product}}'
        );

        $this->dropTable('{{%order_product}}');
    }
}
