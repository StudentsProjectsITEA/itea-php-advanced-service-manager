<?php

namespace common\models;

use frontend\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "avatar".
 *
 * @property string $id
 * @property string $name
 * @property string|null $user_id
 * @property int $created_time
 *
 * @property User $user
 */
class Avatar extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avatar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'created_time'], 'required'],
            [['id', 'user_id'], 'string'],
            [['created_time'], 'default', 'value' => null],
            [['created_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['name'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return array|string[]
     */
    public static function primaryKey()
    {
        return ['id'];
    }
}
