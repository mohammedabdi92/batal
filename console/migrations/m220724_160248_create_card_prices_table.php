<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card_prices}}`.
 */
class m220724_160248_create_card_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card_prices}}', [
            'id' => $this->primaryKey(),
            'card_id'=>$this->integer(),
            'groups_id'=>$this->integer(),
            'price'=>$this->double(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'created_by'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%card_prices}}');
    }
}
