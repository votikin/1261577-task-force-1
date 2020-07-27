<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%review}}`.
 */
class m200526_142816_add_is_complete_column_to_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%review}}', 'is_complete', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%review}}', 'is_complete');
    }
}
