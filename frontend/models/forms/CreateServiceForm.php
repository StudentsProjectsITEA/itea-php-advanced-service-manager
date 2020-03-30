<?php

namespace frontend\models\forms;

use common\models\Category;
use yii\base\Model;

class CreateServiceForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $category_id;
    public $user_id;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['price'], 'integer', 'max' => 10],
            [['imageFile'], 'file', 'extensions' => 'jpg', 'skipOnEmpty' => true, 'maxSize' => 2000000, 'tooBig' => 'Image size limit is 2 mb'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
}
