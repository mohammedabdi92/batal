<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%groups_category}}`.
 */
class m220724_145120_create_groups_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%groups_category}}', [
            'id' => $this->primaryKey(),
            'groups_id'=>$this->integer(),
            'main_category_id'=>$this->integer(),
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
        $this->dropTable('{{%groups_category}}');
    }
}
