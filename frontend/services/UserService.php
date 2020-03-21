<?php

declare(strict_types=1);

namespace frontend\services;

use frontend\models\SignupForm;
use frontend\models\User;
use frontend\repositories\UserRepository;
use frontend\models\LoginForm;
use Ramsey\Uuid\Uuid;
use Yii;


/**
 * Class UserService
 *
 * @package frontend\services
 */
class UserService
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

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
     * @param LoginForm $form
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(LoginForm $form)
    {
        if ($form->validate()) {
            return Yii::$app->user->login(
                $this->getUser($form->username),
                $form->rememberMe ? 3600 * 24 * 30 : 0
            );
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
        if (null === $this->user) {
            $this->user = $this->userRepository->findByUsername($username);
        }

        return $this->user;
    }

    /**
     * Signs user up.
     *
     * @param SignupForm $form
     *
     * @return bool|null whether the creating new account was successful and email was sent
     * @throws \yii\base\Exception
     */
    public function signup(SignupForm $form): ?bool
    {
        if (!$form->validate()) {
            return null;
        }

        $user = new User();
        $user->id = Uuid::uuid4()->toString();
        $user->username = $form->username;
        $user->email = $form->email;
        $user->mobile = $form->mobile;
        $user->setPassword($form->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $this->userRepository->createUser($user) && $this->sendConfirmEmail($user, $form);
    }

    /**
     * Sends confirmation email to user
     *
     * @param User $user
     * @param SignupForm $form
     *
     * @return bool
     */
    private function sendConfirmEmail(User $user, SignupForm $form): bool
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

