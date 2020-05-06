<?php

use yii\db\Migration;

/**
 * Class m200505_171538_alter_column_budget_in_task_table
 */
class m200505_171538_alter_column_budget_in_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%task}}','budget',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%task}}','budget',$this->dateTime()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200505_171538_alter_column_budget_in_task_table cannot be reverted.\n";

        return false;
    }
    */
}
