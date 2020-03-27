<?php

declare(strict_types=1);

namespace frontend\models\forms;

use frontend\models\User;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * User form
 */
class UserForm extends Model
{
    /** @var int $mobile */
    public $mobile;

    /**
     * @var UploadedFile
     */
    public $avatar_name;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile', 'string', 'min' => 10],
            ['mobile', 'unique', 'targetClass' => User::class, 'message' => 'This mobile number has already been taken.'],

            [['avatar_name'], 'file', 'extensions' => 'jpg' ],
        ];
    }
}
