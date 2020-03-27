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
            [['title'], 'string', 'max' => 255],
            [['price'], 'integer'],
            [['imageFile'], 'file', 'extensions' => 'jpg', 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
}
