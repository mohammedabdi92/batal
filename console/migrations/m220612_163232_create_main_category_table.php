<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%main_category}}`.
 */
class m220612_163232_create_main_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%main_category}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(255),
            'status'=> $this->integer(2)->defaultValue(1),
            'image_name'=>$this->string(255)->defaultValue(null),
        ]);
        $this->createTable('{{%sup_category}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(255),
            'main_cat_id'=> $this->integer(2),
            'status'=> $this->integer(2)->defaultValue(1),
            'image_name'=>$this->string(255)->defaultValue(null),
        ]);
        $this->createTable('{{%card}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(255),
            'sup_cat_id'=> $this->integer(2),
            'price'=> $this->float(10),
            'category'=> $this->float(10),
            'status'=> $this->integer(2)->defaultValue(1),
            'image_name'=>$this->string(255)->defaultValue(null),
        ]);

        $this->createTable('{{%stock}}', [
            'id' => $this->primaryKey(),
            'card_id'=> $this->integer(11),
            'user_id'=> $this->float(10)->defaultValue(null),
            'reservation_date'=> $this->timestamp()->defaultValue(null),
            'serial_number'=> $this->string(255),
            'status'=> $this->integer(2)->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%main_category}}');
    }
}
