<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%task}}`
 */
class m200204_180558_create_task_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_image}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'task_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-task_image-task_id}}',
            '{{%task_image}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-task_image-task_id}}',
            '{{%task_image}}',
            'task_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-task_image-task_id}}',
            '{{%task_image}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-task_image-task_id}}',
            '{{%task_image}}'
        );

        $this->dropTable('{{%task_image}}');
    }
}
