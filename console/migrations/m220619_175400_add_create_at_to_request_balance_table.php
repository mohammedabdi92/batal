<?php

use yii\db\Migration;

/**
 * Class m220619_175400_add_create_at_to_request_balance_table
 */
class m220619_175400_add_create_at_to_request_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%request_balance}}', 'create_at', $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220619_175400_add_create_at_to_request_balance_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220619_175400_add_create_at_to_request_balance_table cannot be reverted.\n";

        return false;
    }
    */
}
