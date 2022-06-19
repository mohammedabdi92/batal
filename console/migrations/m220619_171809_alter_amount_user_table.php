<?php

use yii\db\Migration;

/**
 * Class m220619_171809_alter_amount_user_table
 */
class m220619_171809_alter_amount_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%user}}', 'amount', $this->double()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220619_171809_alter_amount_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220619_171809_alter_amount_user_table cannot be reverted.\n";

        return false;
    }
    */
}
