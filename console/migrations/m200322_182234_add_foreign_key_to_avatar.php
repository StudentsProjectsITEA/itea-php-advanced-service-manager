<?php

use yii\db\Migration;

/**
 * Class m200322_182234_add_foreign_key_to_avatar
 */
class m200322_182234_add_foreign_key_to_avatar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('{{%fk-avatar-user_id}}', '{{%avatar}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-avatar-user_id}}', '{{%avatar}}');
    }
}
