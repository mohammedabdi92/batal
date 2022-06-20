<?php

use yii\db\Migration;

/**
 * Class m220620_183154_alter_user_auth_key
 */
class m220620_183154_alter_user_auth_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'auth_key', $this->string(32)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220620_183154_alter_user_auth_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220620_183154_alter_user_auth_key cannot be reverted.\n";

        return false;
    }
    */
}
