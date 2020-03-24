<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m200321_232140_add_table_avatar
 */
class m200321_232140_add_table_avatar extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%avatar}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
            'name' => $this->string()->notNull()->unique(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid'),
            'created_time' => $this->bigInteger()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%avatar_pk}}', '{{%avatar}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%avatar}}');
    }
}
