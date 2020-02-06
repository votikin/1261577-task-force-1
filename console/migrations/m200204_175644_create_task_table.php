<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%city}}`
 */
class m200204_175644_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'short' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'address' => $this->text(),
            'budget' => $this->integer()->notNull(),
            'deadline' => $this->dateTime()->notNull(),
            'latitude' => $this->decimal(9,6),
            'longitude' => $this->decimal(9,6),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->dateTime(),
            'category_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-task-category_id}}',
            '{{%task}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-task-category_id}}',
            '{{%task}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-task-user_id}}',
            '{{%task}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-task-user_id}}',
            '{{%task}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-task-executor_id}}',
            '{{%task}}',
            'executor_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-task-executor_id}}',
            '{{%task}}',
            'executor_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-task-city_id}}',
            '{{%task}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-task-city_id}}',
            '{{%task}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-task-category_id}}',
            '{{%task}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-task-category_id}}',
            '{{%task}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-task-user_id}}',
            '{{%task}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-task-user_id}}',
            '{{%task}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-task-executor_id}}',
            '{{%task}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-task-executor_id}}',
            '{{%task}}'
        );

        // drops foreign key for table `{{%city}}`
        $this->dropForeignKey(
            '{{%fk-task-city_id}}',
            '{{%task}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-task-city_id}}',
            '{{%task}}'
        );

        $this->dropTable('{{%task}}');
    }
}
