<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%task}}`
 */
class m200205_081759_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'description' => $this->text(),
            'estimate' => "ENUM('1','2','3','4','5')"."NOT NULL",
//            'estimate' => $this->enum(1,2,3,4,5)->notNull(),
            'created_at' => $this->timestamp(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-review-user_id}}',
            '{{%review}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-review-user_id}}',
            '{{%review}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-review-task_id}}',
            '{{%review}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-review-task_id}}',
            '{{%review}}',
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
            '{{%fk-review-user_id}}',
            '{{%review}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-review-user_id}}',
            '{{%review}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-review-task_id}}',
            '{{%review}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-review-task_id}}',
            '{{%review}}'
        );

        $this->dropTable('{{%review}}');
    }
}
