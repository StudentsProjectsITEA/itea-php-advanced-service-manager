<?php

use yii\db\Migration;

/**
 * Class m200405_205602_alter_phone_to_table_user
 */
class m200405_205602_alter_phone_to_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'mobile', $this->bigInteger()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'mobile', $this->integer()->notNull());
    }
}
