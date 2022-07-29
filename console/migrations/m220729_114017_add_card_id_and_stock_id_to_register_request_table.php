<?php

use yii\db\Migration;

/**
 * Class m220729_114017_add_card_id_and_stock_id_to_register_request_table
 */
class m220729_114017_add_card_id_and_stock_id_to_register_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%charge_request}}', 'card_id', $this->integer(5));
        $this->addColumn('{{%charge_request}}', 'stock_id', $this->integer(5));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220729_114017_add_card_id_and_stock_id_to_register_request_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220729_114017_add_card_id_and_stock_id_to_register_request_table cannot be reverted.\n";

        return false;
    }
    */
}
