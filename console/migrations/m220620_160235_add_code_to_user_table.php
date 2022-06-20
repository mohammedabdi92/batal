<?php

use yii\db\Migration;

/**
 * Class m220620_160235_add_code_to_user_table
 */
class m220620_160235_add_code_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%user}}', 'reg_code', $this->integer());
        $this->addColumn('{{%user}}', 'reg_code_count', $this->integer(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220620_160235_add_code_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220620_160235_add_code_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
