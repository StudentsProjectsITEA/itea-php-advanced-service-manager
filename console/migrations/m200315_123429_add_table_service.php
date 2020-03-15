<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m200315_123429_add_table_service
 */
class m200315_123429_add_table_service extends Migration
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

        $this->createTable('{{%service}}', [
            'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
            'user_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->notNull(),
            'status_id' => $this->integer()->notNull(),
            'category_id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->notNull(),
            'main_image_name' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->defaultValue(0),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service}}');
    }
}
