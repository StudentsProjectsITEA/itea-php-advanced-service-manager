<?php

use yii\db\Migration;

/**
 * Class m200319_113236_rename_time_columns
 */
class m200319_113236_rename_time_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%user}}', 'created_at', 'created_time');
        $this->renameColumn('{{%user}}', 'updated_at', 'updated_time');
        $this->renameColumn('{{%admin}}', 'created_at', 'created_time');
        $this->renameColumn('{{%admin}}', 'updated_at', 'updated_time');
        $this->renameColumn('{{%category}}', 'created_at', 'created_time');
        $this->renameColumn('{{%category}}', 'updated_at', 'updated_time');
        $this->renameColumn('{{%image}}', 'created_at', 'created_time');
        $this->renameColumn('{{%service}}', 'created_at', 'created_time');
        $this->renameColumn('{{%service}}', 'updated_at', 'updated_time');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%user}}', 'created_time', 'created_at');
        $this->renameColumn('{{%user}}', 'updated_time', 'updated_at');
        $this->renameColumn('{{%admin}}', 'created_time', 'created_at');
        $this->renameColumn('{{%admin}}', 'updated_time', 'updated_at');
        $this->renameColumn('{{%category}}', 'created_time', 'created_at');
        $this->renameColumn('{{%category}}', 'updated_time', 'updated_at');
        $this->renameColumn('{{%image}}', 'created_time', 'created_at');
        $this->renameColumn('{{%service}}', 'created_time', 'created_at');
        $this->renameColumn('{{%service}}', 'updated_time', 'updated_at');
    }
}
