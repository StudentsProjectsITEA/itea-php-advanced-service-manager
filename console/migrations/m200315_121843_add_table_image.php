<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m200315_121843_add_table_image
 */
class m200315_121843_add_table_image extends Migration
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

        $this->createTable('{{%image}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
            'name' => $this->string()->notNull()->unique(),
            'service_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid'),
            'created_at' => $this->bigInteger()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
