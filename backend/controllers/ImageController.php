<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\forms\CreateImageForm;
use common\exceptions\NotFoundImageException;
use common\services\ImageService;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /** @var ImageService $imageService */
    private ImageService $imageService;

    /**
     * ImageController constructor.
     *
     * @param $id
     * @param $module
     * @param ImageService $imageService
     * @param array $config
     */
    public function __construct($id, $module, ImageService $imageService, $config = [])
    {
        $this->imageService = $imageService;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $this->imageService->getImages(),
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
     * Displays a single Image model.
     *
     * @param string $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try {
            $image = $this->imageService->getImageById((string)$id);
        } catch (NotFoundImageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return $this->render(
            'view',
            [
                'model' => $image,
            ]
        );
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new CreateImageForm();

        if (
            $model->load(Yii::$app->request->post())
            && $model->validate()
            && $this->imageService->createImage($model)
        ) {
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
     * Deletes an existing Image model.
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
            $model = $this->imageService->getImageById((string)$id);
        } catch (NotFoundImageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
