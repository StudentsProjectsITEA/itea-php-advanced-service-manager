<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\forms\CreateAvatarForm;
use common\exceptions\NotFoundImageException;
use common\services\AvatarService;

use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AvatarController implements the CRUD actions for Avatar model.
 */
class AvatarController extends Controller
{
    /** @var AvatarService $avatarService */
    private AvatarService $avatarService;

    /**
     * AvatarController constructor.
     *
     * @param $id
     * @param $module
     * @param AvatarService $avatarService
     * @param array $config
     */
    public function __construct($id, $module, AvatarService $avatarService, $config = [])
    {
        $this->avatarService = $avatarService;

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
                        'actions' => ['view', 'create', 'delete'],
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
     * Lists all Avatar models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $this->avatarService->getAvatars(),
            ]
        );

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Avatar model.
     *
     * @param string $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @throws InvalidConfigException
     */
    public function actionView($id)
    {
        try {
            $avatar = $this->avatarService->getAvatarById((string)$id);
        } catch (NotFoundImageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return $this->render(
            'view',
            [
                'model' => $avatar,
            ]
        );
    }

    /**
     * Creates a new Avatar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionCreate()
    {
        $model = new CreateAvatarForm();

        if ($model->load(Yii::$app->request->post()) && $this->avatarService->createAvatar($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Avatar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->avatarService->getAvatarById((string)$id);
        } catch (NotFoundImageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
