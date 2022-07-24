<?php

use yii\db\Migration;

/**
 * Class m220724_184147_add_fields_type_to_main_category_table
 */
class m220724_184147_add_fields_type_to_main_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%main_category}}', 'fields_type', $this->integer(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220724_184147_add_fields_type_to_main_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220724_184147_add_fields_type_to_main_category_table cannot be reverted.\n";

        return false;
    }
    */
}
