<?php

use yii\db\Migration;

/**
 * Class m200315_135840_add_index_columns
 */
class m200315_135840_add_index_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('{{%idx-service-user_id}}', '{{%service}}', 'user_id');
        $this->createIndex('{{%idx-service-category_id}}', '{{%service}}', 'category_id');
        $this->createIndex('{{%idx-image-service_id}}', '{{%image}}', 'service_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-service-user_id}}', '{{%service}}');
        $this->dropIndex('{{%idx-service-category_id}}', '{{%service}}');
        $this->dropIndex('{{%idx-image-service_id}}', '{{%image}}');
    }
}
