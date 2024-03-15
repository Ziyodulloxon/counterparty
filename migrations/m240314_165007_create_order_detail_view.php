<?php

use app\db\models\Order;
use app\db\models\PriceCounterparty;
use app\db\models\PriceRetail;
use yii\db\Migration;

/**
 * Class m240314_165007_create_order_detail_view
 */
class m240314_165007_create_order_detail_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand(<<<SQL
CREATE VIEW order_detail AS
SELECT `order`.`id` as order_id,
       order_product.id,
       DATE(`date_time`) order_date,
       `order`.`counterparty_id`,
       `amount`,
       `status`,
       `order_product`.`product_id`,
       `order_product`.`price`,
       `order_product`.`quantity`,
       IF(price.counterparty_id IS NULL, "price_retail", "price_counterparty") price_type
FROM `order_product`
         LEFT JOIN `order` ON `order`.`id` = `order_product`.`order_id`
         LEFT JOIN (SELECT
                        IF(counterparty_id IS NULL, pc.id, pr.id) as id,
                        pr.product_id,
                        pr.price_date,
                        IF(counterparty_id IS NULL, pc.price, pr.price) price,
                        pc.counterparty_id
                    FROM `price_retail` pr
                    LEFT JOIN price_counterparty pc ON pr.product_id = pc.product_id AND pr.price_date = pc.price_date
                    ) as `price`
                    ON `price`.id = order_product.price_id AND
                       `price`.product_id = order_product.product_id AND
                       `price`.counterparty_id = `order`.counterparty_id AND
                       `price`.price_date = DATE(`date_time`)
GROUP BY order_product.id;
SQL
)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->db->createCommand("DROP VIEW order_detail;")->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240314_165007_create_order_detail_view cannot be reverted.\n";

        return false;
    }
    */
}
