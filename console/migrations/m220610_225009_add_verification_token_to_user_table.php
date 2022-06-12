<?php

use yii\db\Migration;

/**
 * Class m220610_225009_add_verification_token_to_user_table
 */
class m220610_225009_add_verification_token_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220610_225009_add_verification_token_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220610_225009_add_verification_token_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
