<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription_type}}`.
 */
class m200205_091306_create_subscription_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscription_type}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscription_type}}');
    }
}
