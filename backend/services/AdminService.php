<?php

declare(strict_types=1);

namespace backend\services;

use backend\models\Admin;
use backend\repositories\AdminRepository;
use backend\models\forms\LoginForm;
use Yii;


/**
 * Class AdminService
 *
 * @package backend\services
 */
class AdminService
{
    /** @var AdminRepository $adminRepository */
    private AdminRepository $adminRepository;

    /** @var Admin|null $admin */
    private $admin;

    /**
     * AdminService constructor.
     *
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Finds admin by [[username]]
     *
     * @param string $username
     *
     * @return Admin|null
     */
    public function getAdmin(string $username): ?Admin
    {
        if (null === $this->admin) {
            $this->admin = $this->adminRepository->findByUsername($username);
        }

        return $this->admin;
    }

    /**
     * Logs in an admin using the provided username and password.
     *
     * @param LoginForm $form
     *
     * @return bool
     */
    public function login(LoginForm $form)
    {
        if ($form->validate()) {
            return Yii::$app->user->login(
                $this->getAdmin($form->username),
                $form->rememberMe ? 3600 * 24 * 30 : 0
            );
        }

        return false;
    }
}

