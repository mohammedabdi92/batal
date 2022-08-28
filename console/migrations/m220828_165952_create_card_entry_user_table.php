<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card_entry_user}}`.
 */
class m220828_165952_create_card_entry_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card_entry_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->text(),
            'full_name' => $this->text(),
            'phone_number' => $this->text(),
            'email' => $this->text(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(255),
            'status' => $this->integer(2),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%card_entry_user}}');
    }
}
