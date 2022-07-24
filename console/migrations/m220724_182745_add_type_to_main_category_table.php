<?php

use yii\db\Migration;

/**
 * Class m220724_182745_add_type_to_main_category_table
 */
class m220724_182745_add_type_to_main_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%main_category}}', 'type', $this->integer(2)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220724_182745_add_type_to_main_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220724_182745_add_type_to_main_category_table cannot be reverted.\n";

        return false;
    }
    */
}
