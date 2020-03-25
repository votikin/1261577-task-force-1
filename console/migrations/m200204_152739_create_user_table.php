<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%city}}`
 * - `{{%role}}`
 */
class m200204_152739_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->unique()->notNull(),
            'birthday' => $this->date(),
            'phone' => $this->string(),
            'skype' => $this->string(),
            'about' => $this->text(),
            'password' => $this->string()->notNull(),
            'address' => $this->text(),
            'created_at' => $this->timestamp(),
            'view_count' => $this->integer(),
            'is_hidden' => $this->boolean()->defaultValue(0),
            'city_id' => $this->integer(),
            'role_id' => $this->integer()->notNull()->defaultValue(1),
        ]);

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-user-city_id}}',
            '{{%user}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-user-city_id}}',
            '{{%user}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );

        // creates index for column `role_id`
        $this->createIndex(
            '{{%idx-user-role_id}}',
            '{{%user}}',
            'role_id'
        );

        // add foreign key for table `{{%role}}`
        $this->addForeignKey(
            '{{%fk-user-role_id}}',
            '{{%user}}',
            'role_id',
            '{{%role}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%city}}`
        $this->dropForeignKey(
            '{{%fk-user-city_id}}',
            '{{%user}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-user-city_id}}',
            '{{%user}}'
        );

        // drops foreign key for table `{{%role}}`
        $this->dropForeignKey(
            '{{%fk-user-role_id}}',
            '{{%user}}'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            '{{%idx-user-role_id}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
