<?php

declare(strict_types=1);

namespace backend\repositories;

use backend\models\Admin;


/**
 * Class AdminRepository
 *
 * @package backend\repositories
 */
class AdminRepository
{
    /**
     * Finds admin by username
     *
     * @param string $username
     *
     * @return Admin|null
     */
    public function findByUsername(string $username)
    {
        return Admin::findOne(['username' => $username]);
    }
}

