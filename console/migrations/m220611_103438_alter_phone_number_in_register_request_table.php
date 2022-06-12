<?php

use yii\db\Migration;

/**
 * Class m220611_103438_alter_phone_number_in_register_request_table
 */
class m220611_103438_alter_phone_number_in_register_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%register_request}}', 'phone_number', $this->string(50)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220611_103438_alter_phone_number_in_register_request_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220611_103438_alter_phone_number_in_register_request_table cannot be reverted.\n";

        return false;
    }
    */
}
