<?php

declare(strict_types=1);

namespace frontend\models;

use yii\base\Model;


/**
 * Signup form
 */
class SignupForm extends Model
{
    /** @var string $username */
    public $username;

    /** @var string $email */
    public $email;

    /** @var int $mobile */
    public $mobile;

    /** @var string $password */
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This email address has already been taken.'],

            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile', 'string', 'min' => 10],
            ['mobile', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This mobile number has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}

