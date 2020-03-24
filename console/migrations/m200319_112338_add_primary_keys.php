<?php

use yii\db\Migration;

/**
 * Class m200319_112338_add_primary_keys
 */
class m200319_112338_add_primary_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addPrimaryKey('{{%user_pk}}', '{{%user}}', 'id');
        $this->addPrimaryKey('{{%admin_pk}}', '{{%admin}}', 'id');
        $this->addPrimaryKey('{{%category_pk}}', '{{%category}}', 'id');
        $this->addPrimaryKey('{{%image_pk}}', '{{%image}}', 'id');
        $this->addPrimaryKey('{{%service_pk}}', '{{%service}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('{{%user_pk}}', '{{%user}}');
        $this->dropPrimaryKey('{{%admin_pk}}', '{{%admin}}');
        $this->dropPrimaryKey('{{%category_pk}}', '{{%category}}');
        $this->dropPrimaryKey('{{%image_pk}}', '{{%image}}');
        $this->dropPrimaryKey('{{%service_pk}}', '{{%service}}');
    }
}
