<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_balance}}`.
 */
class m220619_174613_create_request_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_balance}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'status'=> $this->integer(2)->defaultValue(1),
            'amount'=>$this->double(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_balance}}');
    }
}
