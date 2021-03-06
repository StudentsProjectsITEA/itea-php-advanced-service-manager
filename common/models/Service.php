<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use frontend\models\User;
use yii\behaviors\TimestampBehavior;

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
 * @property int $created_time
 * @property int $updated_time
 * @property int $serviceStatuses
 * @property Category $category
 * @property User $user
 * @property mixed $imageFile
 */
class Service extends ActiveRecord
{

    /**
     * @var array
     */
    public array $serviceStatuses;

    /**
     * @var mixed
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @return array
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
            [['id', 'user_id', 'category_id', 'description'], 'string'],
            [['user_id', 'status_id', 'category_id', 'title'], 'required'],
            [['status_id', 'price', 'created_time', 'updated_time'], 'default', 'value' => null],
            [['status_id', 'price', 'created_time', 'updated_time'], 'integer'],
            [['main_image_name', 'title'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['title'], 'string', 'max' => 50],
            [['price'], 'integer', 'max' => 1000000000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status',
            'main_image_name' => 'Image',
            'description' => 'Description',
            'price' => 'Price',
            'title' => 'Title',
            'created_time' => 'Created',
            'updated_time' => 'Updated',
            'category.title' => 'Category',
            'user.username' => 'User',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
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

    public function getImagePath()
    {
        return $this->main_image_name ? '/uploads/services/' . $this->main_image_name : false;
    }
}
