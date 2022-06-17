<?php

use yii\db\Migration;

/**
 * Class m220617_160945_add_code_to_stock_table
 */
class m220617_160945_add_code_to_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stock}}', 'code', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_160945_add_code_to_stock_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_160945_add_code_to_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
