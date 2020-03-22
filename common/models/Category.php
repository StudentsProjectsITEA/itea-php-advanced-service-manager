<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "category".
 *
 * @property string|null $id
 * @property string $title
 * @property string|null $description
 * @property int $created_time
 * @property int $updated_time
 *
 * @property Service[] $service
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
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
            'updatedAtAttribute' => 'updated_time',
        ],
    ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'description'], 'string'],
            [['created_time', 'updated_time'], 'default', 'value' => null],
            [['created_time', 'updated_time'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => 'Title',
            'description' => 'Description',
            'created_time'  => 'Created At',
            'updated_time'  => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Services]].
     *
     * @return ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['category_id' => 'id']);
    }

    public function getCategories()
    {
        return Category::find();
    }

    public static function primaryKey()
    {
        return ['id'];
    }
}
