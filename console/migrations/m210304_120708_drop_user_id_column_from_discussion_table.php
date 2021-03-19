<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%discussion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210304_120708_drop_user_id_column_from_discussion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

        $this->dropColumn('{{%discussion}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%discussion}}', 'user_id', $this->integer());

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
    }
}
