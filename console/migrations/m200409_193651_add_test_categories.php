<?php

use yii\db\Migration;

/**
 * Class m200409_193651_add_test_categories
 */
class m200409_193651_add_test_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%category}}',[
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Construction',
            'description' => 'Test category construction',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}',[
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Cosmetology',
            'description' => 'Test category cosmetology',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%category}}',[
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Tourism',
            'description' => 'Test category tourism',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%category}}', [
            'title' => 'Construction',
        ]);

        $this->delete('{{%category}}', [
            'title' => 'Cosmetology',
        ]);

        $this->delete('{{%category}}', [
            'title' => 'Tourism',
        ]);


    }
}
