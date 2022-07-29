<?php

use yii\db\Migration;

/**
 * Class m220729_125756_add_amount_to_stock_table
 */
class m220729_125756_add_amount_to_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stock}}', 'amount', $this->double());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220729_125756_add_amount_to_stock_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220729_125756_add_amount_to_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
