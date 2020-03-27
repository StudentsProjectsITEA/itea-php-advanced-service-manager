<?php

namespace backend\models\forms;

use yii\base\Model;

class CreateCategoryForm extends Model
{
    public $id;
    public $title;
    public $description;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }
}
