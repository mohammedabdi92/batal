<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%charge_request}}`.
 */
class m220729_100734_create_charge_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%charge_request}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'status'=>$this->integer(),
            'fields_type'=>$this->integer(),
            'field_name'=>$this->text(),
            'field_email'=>$this->text(),
            'field_password'=>$this->text(),
            'field_id'=>$this->text(),
            'field_phone_number'=>$this->text(),
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
        $this->dropTable('{{%charge_request}}');
    }
}
