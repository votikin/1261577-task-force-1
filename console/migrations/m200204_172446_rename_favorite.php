<?php

use yii\db\Migration;

/**
 * Class m200204_172446_rename_favorite
 */
class m200204_172446_rename_favorite extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('favorite','favorite_executor');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('favorite_executor','favorite');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200204_172446_rename_favorite cannot be reverted.\n";

        return false;
    }
    */
}
