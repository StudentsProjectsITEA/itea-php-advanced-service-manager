<?php

use yii\db\Migration;

/**
 * Class m200409_191335_delete_table_avatar_and_image
 */
class m200409_191335_delete_table_avatar_and_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%image}}');
        $this->dropTable('{{%avatar}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
            'name' => $this->string()->notNull()->unique(),
            'service_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid'),
            'created_at' => $this->bigInteger()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('{{%fk-avatar-user_id}}', '{{%avatar}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->createTable('{{%avatar}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
            'name' => $this->string()->notNull()->unique(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid'),
            'created_time' => $this->bigInteger()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%avatar_pk}}', '{{%avatar}}', 'id');
    }
}
