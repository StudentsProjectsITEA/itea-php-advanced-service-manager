<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200315_114233_add_advanced_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'mobile', $this->integer()->notNull()->unique());
        $this->addColumn('{{%user}}', 'avatar_name', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'mobile');
        $this->dropColumn('{{%user}}', 'avatar_name');
    }
}
