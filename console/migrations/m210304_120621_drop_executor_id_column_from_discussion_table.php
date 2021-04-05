<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%discussion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210304_120621_drop_executor_id_column_from_discussion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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

        $this->dropColumn('{{%discussion}}', 'executor_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%discussion}}', 'executor_id', $this->integer());

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
    }
}
