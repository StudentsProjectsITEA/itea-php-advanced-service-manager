<?php

use \Ramsey\Uuid\Uuid;
use yii\db\Migration;

/**
 * Class m200315_145631_add_test_admin
 */
class m200315_145631_add_test_admin extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $this->insert('{{%admin}}',[
            'id' => Uuid::uuid4()->toString(),
            'username' => 'admin',
            'email' => 'admin@phppro.pw',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%admin}}', [
            'username' => 'admin',
        ]);
    }
}
