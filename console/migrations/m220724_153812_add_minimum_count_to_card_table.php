<?php

use yii\db\Migration;

/**
 * Class m220724_153812_add_minimum_count_to_card_table
 */
class m220724_153812_add_minimum_count_to_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%card}}', 'minimum_count', $this->integer(5));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220724_153812_add_minimum_count_to_card_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220724_153812_add_minimum_count_to_card_table cannot be reverted.\n";

        return false;
    }
    */
}
