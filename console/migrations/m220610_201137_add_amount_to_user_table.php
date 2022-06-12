<?php

use yii\db\Migration;

/**
 * Class m220610_201137_add_amount_to_user_table
 */
class m220610_201137_add_amount_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'amount', $this->float(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220610_201137_add_amount_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220610_201137_add_amount_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
