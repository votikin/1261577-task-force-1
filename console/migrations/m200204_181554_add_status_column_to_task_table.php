<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%task_status}}`
 */
class m200204_181554_add_status_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'status_id', $this->integer()->notNull());

        // creates index for column `status_id`
        $this->createIndex(
            '{{%idx-task-status_id}}',
            '{{%task}}',
            'status_id'
        );

        // add foreign key for table `{{%task_status}}`
        $this->addForeignKey(
            '{{%fk-task-status_id}}',
            '{{%task}}',
            'status_id',
            '{{%task_status}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%task_status}}`
        $this->dropForeignKey(
            '{{%fk-task-status_id}}',
            '{{%task}}'
        );

        // drops index for column `status_id`
        $this->dropIndex(
            '{{%idx-task-status_id}}',
            '{{%task}}'
        );

        $this->dropColumn('{{%task}}', 'status_id');
    }
}
