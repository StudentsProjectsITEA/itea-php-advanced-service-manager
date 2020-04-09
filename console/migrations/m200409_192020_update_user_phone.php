<?php

use yii\db\Migration;

/**
 * Class m200409_192020_update_user_phone
 */
class m200409_192020_update_user_phone extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('{{%user}}', ['mobile' => 380661111111], ['username' => 'testuser']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->update('{{%user}}', ['mobile' => 0661111111], ['username' => 'testuser']);
    }
}
