<?php

declare(strict_types=1);

namespace frontend\services;

use backend\models\forms\CreateAvatarForm;
use common\services\AvatarService;
use frontend\models\forms\UserForm;
use frontend\models\SignupForm;
use frontend\models\User;
use frontend\repositories\UserRepository;
use frontend\models\LoginForm;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\db\StaleObjectException;
use yii\web\UploadedFile;


/**
 * Class UserService
 *
 * @package frontend\services
 */
class UserService
{
    /** @var UserRepository $userRepository */

    private $userRepository;

    /** @var User|null $user */
    private $user;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @param AvatarService $avatarService
     */
    public function __construct(UserRepository $userRepository, AvatarService $avatarService)
    {
        $this->userRepository = $userRepository;
        $this->avatarService = $avatarService;
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
     * @param $id
     *
     * @return User|null
     */
    public function getUserById($id): ?User
    {
        return $this->userRepository->findOneUser($id);
    }

    /**
     * @param string $id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getUserServices(string $id) : array
    {
        return $this->userRepository->findUserServices($id);
    }

    /**
     * @param string $id
     * @return string
     */
    public function getUserServicesCount(string $id) : int
    {
        return $this->userRepository->findAndCountUserServices($id);
    }

    /**
     * @param string $id
     * @param $pageOffset
     * @param $pageLimit
     * @return array
     */
    public function getPagination(string $id, $pageOffset, $pageLimit) : array
    {
        return $this->userRepository->getServicesForPaginationByUserId($id, $pageOffset, $pageLimit);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function findAllUsers()
    {
        return $this->userRepository->findAllUsers();
    }

    /**
     * @param UserForm $userForm
     *
     * @return bool
     *
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function updateUserAvatar(UserForm $userForm)
    {
        if (!$userForm->validate()) {
            return false;
        }

        $user = $this->getUserById($this->user->id);

        $fileForm = new CreateAvatarForm();
        $imageData = UploadedFile::getInstance($userForm, 'avatar_name');

        if (!empty($imageData)) {
            $this->avatarService->deleteAvatarByUserId($this->user->id);

            $fileForm->imageFile = $imageData;

            $createdAvatarStatus = $this->avatarService->createAvatar($fileForm);

            $createdAvatar = $this->avatarService->getAvatarByUserId($this->user->id);

            $avatarUrl = $this->avatarService->getAvatarUrl($createdAvatar);

            $user->avatar_name = $avatarUrl;
            $user->mobile = $userForm->mobile;
        }

        if ($this->userRepository->saveUser($user) && $createdAvatarStatus) {
            return true;
        }

        $user->addErrors($user->getErrors());
        \Yii::error('', __METHOD__);

        return false;
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

        return $this->userRepository->saveUser($user) && $this->sendConfirmEmail($user, $form);
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user): bool
    {
        return $this->userRepository->saveUser($user);
    }

    /**
     * @param User $user
     *
     * @return bool
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function delete(User $user): bool
    {
        $id = $user->getId();
        if ($this->userRepository->findService($id) || $this->userRepository->findAvatar($id)){
            return false;
        }

        return $this->userRepository->deleteUser($user);
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
