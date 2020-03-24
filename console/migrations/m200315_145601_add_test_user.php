<?php

use \Ramsey\Uuid\Uuid;
use yii\db\Migration;

/**
 * Class m200315_145601_add_test_user
 */
class m200315_145601_add_test_user extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'id' => Uuid::uuid4()->toString(),
            'username' => 'testuser',
            'email' => 'testuser@phppro.pw',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('testuser'),
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
            'mobile' => 0661111111,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', [
            'username' => 'testuser',
        ]);
    }
}
