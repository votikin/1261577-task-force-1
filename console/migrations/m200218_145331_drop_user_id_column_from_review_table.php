<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%review}}`.
 */
class m200218_145331_drop_user_id_column_from_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

        $this->dropColumn('{{%review}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%review}}', 'user_id', $this->integer());

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
    }
}
