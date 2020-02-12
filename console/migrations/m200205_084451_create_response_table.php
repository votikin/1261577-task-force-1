<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%response}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%task}}`
 */
class m200205_084451_create_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%response}}', [
            'id' => $this->primaryKey(),
            'comment' => $this->text(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-response-user_id}}',
            '{{%response}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-response-user_id}}',
            '{{%response}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-response-task_id}}',
            '{{%response}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-response-task_id}}',
            '{{%response}}',
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
            '{{%fk-response-user_id}}',
            '{{%response}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-response-user_id}}',
            '{{%response}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-response-task_id}}',
            '{{%response}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-response-task_id}}',
            '{{%response}}'
        );

        $this->dropTable('{{%response}}');
    }
}
