<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoices}}`.
 */
class m220829_183126_create_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoices}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'amount' => $this->integer(),
            'note' => $this->text(),
            'image_name' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invoices}}');
    }
}
