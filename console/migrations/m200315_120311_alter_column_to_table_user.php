<?php

use yii\base\NotSupportedException;
use yii\db\Migration;

/**
 * Class m200315_120311_alter_column_to_table_user
 */
class m200315_120311_alter_column_to_table_user extends Migration
{
    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'id');
        $this->addColumn('{{%user}}', 'id', $this->getDb()->getSchema()->createColumnSchemaBuilder('uuid')->unique());
        $this->alterColumn('{{%user}}', 'created_at', $this->bigInteger()->notNull());
        $this->alterColumn('{{%user}}', 'updated_at', $this->bigInteger()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'id');
        $this->addColumn('{{%user}}', 'id', $this->primaryKey());
        $this->alterColumn('{{%user}}', 'created_at', $this->integer()->notNull());
        $this->alterColumn('{{%user}}', 'updated_at', $this->integer()->notNull());
    }
}
