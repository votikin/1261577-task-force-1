<?php

use yii\db\Migration;

/**
 * Class m200505_170717_alter_column_deadline_in_task_table
 */
class m200505_170717_alter_column_deadline_in_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%task}}','deadline',$this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%task}}','deadline',$this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200505_170717_alter_column_deadline_in_task_table cannot be reverted.\n";

        return false;
    }
    */
}
