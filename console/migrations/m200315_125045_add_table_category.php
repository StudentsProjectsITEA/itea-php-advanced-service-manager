<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m200315_125045_add_table_category
 */
class m200315_125045_add_table_category extends Migration
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

        $this->createTable(
            '{{%category}}',
            [
                'id' => $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique(),
                'title' => $this->string()->notNull(),
                'description' => $this->text(),
                'created_at' => $this->bigInteger()->notNull(),
                'updated_at' => $this->bigInteger()->notNull(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
