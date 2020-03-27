<?php

declare(strict_types=1);

namespace frontend\repositories;

use common\models\Avatar;
use common\models\Service;
use frontend\models\User;

/**
 * Class UserRepository
 *
 * @package frontend\repositories
 */
class UserRepository
{
    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return User|null
     */
    public function findByUsername(string $username)
    {
        return User::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    /**
     * @param string $id
     *
     * @return User|null
     */
    public function findOneUser(string $id)
    {
        return User::findOne(['id' => $id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function findAllUsers()
    {
        return User::find();
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function saveUser(User $user): bool
    {
        return $user->save();
    }

    /**
     * @param User $user
     *
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteUser(User $user): bool
    {
        if ($user->delete()) {
            return true;
        }

        return false;
    }

    /**
     * @param string $user_id
     *
     * @return Service|null
     */
    public function findService(string $user_id): ?Service
    {
        return Service::findOne(['user_id' => $user_id]);
    }

    /**
     * @param string $id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findUserServices(string $id)
    {
        return Service::find()->where(['user_id' => $id, 'status_id' => [9, 10]])->all();
    }

    /**
     * @param string $id
     * @return string
     */
    public function findAndCountUserServices(string $id): int
    {
        return Service::find()->where(['user_id' => $id, 'status_id' => [9, 10]])->count();
    }

    /**
     * @param $id
     * @param $pageOffset
     * @param $pageLimit
     * @return array
     */
    public function getServicesForPaginationByUserId($id, $pageOffset, $pageLimit) : array
    {
        return Service::find()->where(['user_id' => $id, 'status_id' => [9, 10]])->offset($pageOffset)->limit($pageLimit)->all();
    }

    /**
     * @param string $user_id
     *
     * @return Avatar|null
     */
    public function findAvatar(string $user_id): ?Avatar
    {
        return Avatar::findOne(['user_id' => $user_id]);
    }
}
