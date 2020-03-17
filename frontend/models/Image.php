<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property string|null $id
 * @property string $name
 * @property string|null $service_id
 * @property int $created_at
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
    public function rules()
    {
        return [
            [['id', 'service_id'], 'string'],
            [['name', 'created_at'], 'required'],
            [['created_at'], 'default', 'value' => null],
            [['created_at'], 'integer'],
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
            'service_id' => 'Service ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
