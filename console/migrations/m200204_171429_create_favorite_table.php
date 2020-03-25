<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m200204_171429_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'executor_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-favorite-user_id}}',
            '{{%favorite}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-favorite-user_id}}',
            '{{%favorite}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-favorite-executor_id}}',
            '{{%favorite}}',
            'executor_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-favorite-executor_id}}',
            '{{%favorite}}',
            'executor_id',
            '{{%user}}',
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
            '{{%fk-favorite-user_id}}',
            '{{%favorite}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-favorite-user_id}}',
            '{{%favorite}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-favorite-executor_id}}',
            '{{%favorite}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-favorite-executor_id}}',
            '{{%favorite}}'
        );

        $this->dropTable('{{%favorite}}');
    }
}
