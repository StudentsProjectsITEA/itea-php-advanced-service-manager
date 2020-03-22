<?php

declare(strict_types=1);

namespace frontend\services;

use frontend\models\User;
use frontend\repositories\UserRepository;
use frontend\models\LoginForm;
use Yii;


/**
 * Class UserService
 *
 * @package frontend\services
 */
class UserService
{
    /** @var UserRepository $userRepository */
//    private UserRepository $userRepository;
    private $userRepository;

    /** @var User|null $user */
    private $user;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @param LoginForm $loginForm
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(LoginForm $loginForm)
    {
        if ($loginForm->validate()){
            return Yii::$app->user->login($this->getUser($loginForm->username), $loginForm->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @param string $username
     *
     * @return User|null
     */
    public function getUser(string $username): ?User
    {
        if (null === $this->user){
            $this->user = $this->userRepository->findByUsername($username);
        }

        return $this->user;
    }
}

