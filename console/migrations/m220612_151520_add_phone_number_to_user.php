<?php

use yii\db\Migration;

/**
 * Class m220612_151520_add_phone_number_to_user
 */
class m220612_151520_add_phone_number_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'phone_number', $this->string(50)->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220612_151520_add_phone_number_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220612_151520_add_phone_number_to_user cannot be reverted.\n";

        return false;
    }
    */
}
