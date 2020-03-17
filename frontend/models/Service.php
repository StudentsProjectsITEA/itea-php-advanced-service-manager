<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property string|null $id
 * @property string $user_id
 * @property int $status_id
 * @property string $category_id
 * @property string|null $main_image_name
 * @property string $title
 * @property string|null $description
 * @property int|null $price
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Image[] $images
 * @property Category $category
 * @property User $user
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'description'], 'string'],
            [['user_id', 'status_id', 'category_id', 'title', 'created_at', 'updated_at'], 'required'],
            [['status_id', 'price', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status_id', 'price', 'created_at', 'updated_at'], 'integer'],
            [['main_image_name', 'title'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'category_id' => 'Category ID',
            'main_image_name' => 'Main Image Name',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['service_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
