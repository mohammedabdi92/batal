<?php

use yii\db\Migration;

/**
 * Class m220724_101157_add_phone_number_and_full_name_table
 */
class m220724_101157_add_phone_number_and_full_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%admin}}', 'full_name', $this->string(255));
        $this->addColumn('{{%admin}}', 'phone_number', $this->string(255));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220724_101157_add_phone_number_and_full_name_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220724_101157_add_phone_number_and_full_name_table cannot be reverted.\n";

        return false;
    }
    */
}
