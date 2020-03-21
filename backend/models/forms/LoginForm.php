<?php

declare(strict_types=1);

namespace backend\models\forms;

use backend\services\AdminService;
use backend\models\Admin;
use yii\base\Model;
use Yii;


/**
 * Class LoginForm
 *
 * @package backend\models\forms
 */
class LoginForm extends Model
{
    /** @var string $username */
    public $username;

    /** @var string $password */
    public $password;

    /** @var bool $rememberMe */
    public bool $rememberMe = true;

    /**
     * @return array
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
     * @param $attribute
     * @param $params
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            /** @var AdminService $adminService */
            $adminService = Yii::$container->get(AdminService::class);

            /** @var Admin|null $admin */
            $admin = $adminService->getAdmin($this->username);

            if (!$admin || !$admin->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
}

