<?php

namespace frontend\controllers;

use frontend\services\UserService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /** @var UserService $userService */
    private UserService $userService;

    /**
     * UserController constructor.
     *
     * @param $id
     * @param $module
     * @param array $config
     * @param UserService $userService
     */
    public function __construct($id, $module, $config = [], UserService $userService)
    {
        $this->userService = $userService;
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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view', 'create', 'update', 'delete'],
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
     * Displays a single User model.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $user = $this->userService->getUserById($id);
        return $this->render(
            'view',
            [
                'model' => $user,
            ]
        );
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->userService->getUserById($id);
        if ($model->load(Yii::$app->request->post()) && $this->userService->save($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }
}
