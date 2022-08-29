<?php

use yii\db\Migration;

/**
 * Class m220829_190110_alter_invoices_table
 */
class m220829_190110_alter_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%invoices}}', 'created_at', $this->integer());
        $this->addColumn('{{%invoices}}', 'created_by', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220829_190110_alter_invoices_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220829_190110_alter_invoices_table cannot be reverted.\n";

        return false;
    }
    */
}
