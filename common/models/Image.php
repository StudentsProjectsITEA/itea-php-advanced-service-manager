<?php

namespace common\models;

use Yii;
use frontend\models\Service;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

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
class Image extends \yii\db\ActiveRecord
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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_time',
            ],
        ];
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
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
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
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    public static function primaryKey()
    {
        return ['id'];
    }
}
