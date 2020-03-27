<?php

declare(strict_types=1);

namespace frontend\controllers;

use backend\models\forms\CreateImageForm;
use common\exceptions\NotFoundPageException;
use frontend\services\UserService;
use common\components\ServiceService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Class ServiceController
 * @package frontend\controllers
 */
class ServiceController extends AppControllers
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
     * ServiceController constructor.
     * @param $id
     * @param $module
     * @param array $config
     * @param UserService $userService
     * @param ServiceService $serviceService
     */
    public function __construct($id, $module, UserService $userService, ServiceService $serviceService, $config = [])
    {
        $this->userService = $userService;
        $this->serviceService = $serviceService;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['delete', 'update'],
                'rules' => [
                    [
                        'actions' => ['delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->serviceService->getServiceById($id);

        if (empty($model) || 0 === $model->status_id) {
            throw new NotFoundHttpException;
        }

        $currentUser = $this->userService->getUserById($model->user_id);
        return $this->render('view', [
            'currentService' => $model,
            'currentUser' => $currentUser,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->serviceService->getServiceById($id);

        if (empty($model) || 0 === $model->status_id) {
            throw new NotFoundHttpException;
        }

        if (
            $model->load(Yii::$app->request->post())
            && $model->validate()
            && $this->serviceService->updateService($model)
            ) {
                return $this->redirect(['service/view', 'id' => $model->id]);
        }

        if ($model->user_id !== Yii::$app->user->id) {
            return $this->render(
                'notice',
                [
                    'status' => 'Error',
                    'notice' => 'You cant edit this service',
                    'backLink' => 'service/view?id=' . $model->id
                ]
            );
        }

        $categories = $this->serviceService->getCategoriesList();
        return $this->render(
            'update',
            [
                'model' => $model,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'account' page.
     *
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->serviceService->getServiceById($id);
        } catch (NotFoundPageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        if ($model->user_id !== Yii::$app->user->id) {
            return $this->render(
                'notice',
                [
                    'status' => 'Error',
                    'notice' => 'You cant delete this service',
                    'backLink' => 'service/view?id=' . $model->id
                ]
            );
        }

        $this->serviceService->deleteService($model);

        return $this->redirect(['/account/', 'id' => Yii::$app->user->id]);
    }
}
