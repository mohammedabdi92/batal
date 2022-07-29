<?php

use yii\db\Migration;

/**
 * Class m220729_093645_add_group_id_to_register_request_table
 */
class m220729_093645_add_group_id_to_register_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%register_request}}', 'group_id', $this->integer(5));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220729_093645_add_group_id_to_register_request_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220729_093645_add_group_id_to_register_request_table cannot be reverted.\n";

        return false;
    }
    */
}
