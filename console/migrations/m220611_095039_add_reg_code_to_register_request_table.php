<?php

use yii\db\Migration;

/**
 * Class m220611_095039_add_reg_code_to_register_request_table
 */
class m220611_095039_add_reg_code_to_register_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%register_request}}', 'reg_code', $this->string(5));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220611_095039_add_reg_code_to_register_request_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220611_095039_add_reg_code_to_register_request_table cannot be reverted.\n";

        return false;
    }
    */
}
