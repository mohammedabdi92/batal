<?php

use yii\db\Migration;

/**
 * Class m220828_184631_add_created_at_and_updated_at_to_stock
 */
class m220828_184631_add_created_at_and_updated_at_to_stock extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stock}}', 'created_at', $this->integer());
        $this->addColumn('{{%stock}}', 'created_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220828_184631_add_created_at_and_updated_at_to_stock cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220828_184631_add_created_at_and_updated_at_to_stock cannot be reverted.\n";

        return false;
    }
    */
}
