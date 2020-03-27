<?php

declare(strict_types=1);

namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class CreateAvatarForm
 *
 * @package backend\models\forms
 */
class CreateAvatarForm extends Model
{
    public $id;
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'jpg'],
        ];
    }
}
