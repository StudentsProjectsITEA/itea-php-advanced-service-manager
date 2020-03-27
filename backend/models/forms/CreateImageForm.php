<?php

declare(strict_types=1);

namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class CreateImageForm
 *
 * @package backend\models\forms
 */
class CreateImageForm extends Model
{
    public $id;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'jpg'],
        ];
    }
}
