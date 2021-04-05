<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%discussion}}`.
 */
class m210322_121346_add_is_customer_view_column_to_discussion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%discussion}}', 'is_customer_view', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%discussion}}', 'is_customer_view');
    }
}
