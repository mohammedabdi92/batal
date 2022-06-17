<?php

use yii\db\Migration;

/**
 * Class m220617_142950_add_count_to_card_table
 */
class m220617_142950_add_count_to_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%card}}', 'count', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_142950_add_count_to_card_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_142950_add_count_to_card_table cannot be reverted.\n";

        return false;
    }
    */
}
