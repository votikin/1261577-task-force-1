<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discussion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%task}}`
 */
class m200204_180029_create_discussion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discussion}}', [
            'id' => $this->primaryKey(),
            'message' => $this->text()->notNull(),
            'created_at' => $this->timestamp(),
            'user_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-discussion-user_id}}',
            '{{%discussion}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-discussion-user_id}}',
            '{{%discussion}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-discussion-executor_id}}',
            '{{%discussion}}',
            'executor_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-discussion-executor_id}}',
            '{{%discussion}}',
            'executor_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-discussion-task_id}}',
            '{{%discussion}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-discussion-task_id}}',
            '{{%discussion}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-discussion-user_id}}',
            '{{%discussion}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-discussion-user_id}}',
            '{{%discussion}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-discussion-executor_id}}',
            '{{%discussion}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-discussion-executor_id}}',
            '{{%discussion}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-discussion-task_id}}',
            '{{%discussion}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-discussion-task_id}}',
            '{{%discussion}}'
        );

        $this->dropTable('{{%discussion}}');
    }
}
