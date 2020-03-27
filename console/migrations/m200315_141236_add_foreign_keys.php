<?php

use yii\db\Migration;

/**
 * Class m200315_141236_add_foreign_keys
 */
class m200315_141236_add_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('{{%fk-service-category_id}}', '{{%service}}', 'category_id', '{{%category}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-service-user_id}}', '{{%service}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-image-service_id}}', '{{%image}}', 'service_id', '{{%service}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-service-category_id}}', '{{%service}}');
        $this->dropForeignKey('{{%fk-service-user_id}}', '{{%service}}');
        $this->dropForeignKey('{{%fk-image-service_id}}', '{{%image}}');
    }
}
