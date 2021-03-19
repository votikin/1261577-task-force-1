<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%discussion}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210304_120740_add_author_id_column_to_discussion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%discussion}}', 'author_id', $this->integer());

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-discussion-author_id}}',
            '{{%discussion}}',
            'author_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-discussion-author_id}}',
            '{{%discussion}}',
            'author_id',
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
            '{{%fk-discussion-author_id}}',
            '{{%discussion}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-discussion-author_id}}',
            '{{%discussion}}'
        );

        $this->dropColumn('{{%discussion}}', 'author_id');
    }
}
