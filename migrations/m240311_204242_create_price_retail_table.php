<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_retail}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 */
class m240311_204242_create_price_retail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price_retail}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(10),
            'price_date' => $this->date(),
            'price' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-price_retail-product_id}}',
            '{{%price_retail}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-price_retail-product_id}}',
            '{{%price_retail}}',
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
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-price_retail-product_id}}',
            '{{%price_retail}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-price_retail-product_id}}',
            '{{%price_retail}}'
        );

        $this->dropTable('{{%price_retail}}');
    }
}
