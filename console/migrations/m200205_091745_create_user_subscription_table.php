<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_subscription}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%subscription_type}}`
 */
class m200205_091745_create_user_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_subscription}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'subscription_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_subscription-user_id}}',
            '{{%user_subscription}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_subscription-user_id}}',
            '{{%user_subscription}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `subscription_id`
        $this->createIndex(
            '{{%idx-user_subscription-subscription_id}}',
            '{{%user_subscription}}',
            'subscription_id'
        );

        // add foreign key for table `{{%subscription_type}}`
        $this->addForeignKey(
            '{{%fk-user_subscription-subscription_id}}',
            '{{%user_subscription}}',
            'subscription_id',
            '{{%subscription_type}}',
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
            '{{%fk-user_subscription-user_id}}',
            '{{%user_subscription}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_subscription-user_id}}',
            '{{%user_subscription}}'
        );

        // drops foreign key for table `{{%subscription_type}}`
        $this->dropForeignKey(
            '{{%fk-user_subscription-subscription_id}}',
            '{{%user_subscription}}'
        );

        // drops index for column `subscription_id`
        $this->dropIndex(
            '{{%idx-user_subscription-subscription_id}}',
            '{{%user_subscription}}'
        );

        $this->dropTable('{{%user_subscription}}');
    }
}
