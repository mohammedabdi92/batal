<?php

use yii\db\Migration;

/**
 * Class m220617_171549_add_sup_id_to_sup_caregory_table
 */
class m220617_171549_add_sup_id_to_sup_caregory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%sup_category}}', 'sup_cat_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_171549_add_sup_id_to_sup_caregory_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_171549_add_sup_id_to_sup_caregory_table cannot be reverted.\n";

        return false;
    }
    */
}
