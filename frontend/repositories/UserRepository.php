<?php

declare(strict_types=1);

namespace frontend\repositories;

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
}

