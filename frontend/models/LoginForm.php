<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\services\UserService;
use Yii;
use yii\base\Model;


/**
 * Class LoginForm
 *
 * @package frontend\models
 */
class LoginForm extends Model
{
    /** @var string $username */
    public $username;

    /** @var string $password */
    public $password;

    /** @var bool $rememberMe */
//    deleted bool
    public $rememberMe = true;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            /** @var UserService $userService */
            $userService = Yii::$container->get(UserService::class);

            /** @var User|null $user */
            $user = $userService->getUser($this->username);

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
}

