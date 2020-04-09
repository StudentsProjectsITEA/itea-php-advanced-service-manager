<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\components\ServiceService;
use common\services\ImageService;
use frontend\models\forms\CreateServiceForm;
use frontend\models\forms\UserForm;
use frontend\services\UserService;
use Yii;
use yii\helpers\Url;
use yii\data\Pagination;


/**
 * Class AccountController
 * @package frontend\controllers
 */
class AccountController extends AppControllers
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @var ServiceService
     */
    private ServiceService $serviceService;

    /**
     * @var ImageService
     */
    private ImageService $imageService;

    /**
     * AccountController constructor.
     *
     * @param $id
     * @param $module
     * @param UserService $userService
     * @param ServiceService $serviceService
     * @param ImageService $imageService
     * @param array $config
     */
    public function __construct($id, $module, UserService $userService, ServiceService $serviceService, ImageService $imageService, $config = [])
    {
        $this->userService = $userService;
        $this->serviceService = $serviceService;
        $this->imageService = $imageService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionIndex($id)
    {
        if (!\Yii::$app->user->id) {
            return $this->goHome();
        } else {
            $serviceModel = new CreateServiceForm();
            if (
                $serviceModel->load(Yii::$app->request->post())
                && $serviceModel->validate()
                && $this->serviceService->createService($serviceModel)
            ) {
                return Yii::$app->response->redirect(Url::to(['service/view', 'id' => $serviceModel->id]));
            }

            $user = $this->userService->getUserById($id);
            $userForm = new UserForm($user);
            if ($userForm->load(Yii::$app->request->post()) && $this->userService->updateUser($user, $userForm)){
                Yii::$app->session->setFlash('success', 'Updated');
                return $this->redirect(Url::to(['account/index', 'id' => $id]));
            }

            $pages = new Pagination(['totalCount' => $this->userService->getUserServicesCount($id),'pageSize' => 8]);
            $usersServices = $this->userService->getPagination($id, $pages->offset, $pages->limit);

            $categories = $this->serviceService->getCategoriesList();
            return $this->render('index', [
                'usersServices' => $usersServices,
                'serviceModel' => $serviceModel,
                'categories' => $categories,
                'pages' => $pages,
                'user' => $user,
                'userForm' => $userForm,
            ]);
        }
    }
}

