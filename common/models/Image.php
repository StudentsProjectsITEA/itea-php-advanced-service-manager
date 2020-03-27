<?php

namespace common\models;

use Yii;
use common\models\Service;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "image".
 *
 * @property string|null $id
 * @property string $name
 * @property string|null $service_id
 * @property int $created_time
 *
 * @property Service $service
 */
class Image extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'service_id'], 'string'],
            [['name', 'created_time'], 'required'],
            [['created_time'], 'default', 'value' => null],
            [['created_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['name'], 'unique'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
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
            'created_time' => 'Created Time',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * @return array|string[]
     */
    public static function primaryKey()
    {
        return ['id'];
    }
}
