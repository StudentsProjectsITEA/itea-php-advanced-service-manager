<?php

namespace backend\controllers;

use backend\models\forms\CreateCategoryForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\StaleObjectException;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use common\models\Category;
use common\components\CategoryService;
use common\exceptions\NotFoundPageException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{

    private $categoryService;

    public function __construct($id, $module, CategoryService $categoryService, $config = [])
    {
        $this->categoryService = $categoryService;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $this->categoryService->getCategories(),
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
     * Displays a single Category model.
     *
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try {
            $category = $this->categoryService->getCategoryById((string)$id);
        } catch (NotFoundPageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return $this->render(
            'view',
            [
                'model' => $category,
            ]
        );
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new CreateCategoryForm();

        if (
            $model->load(Yii::$app->request->post())
            && $model->validate()
            && $this->categoryService->createCategory($model)
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        try {
            $model = $this->categoryService->getCategoryById($id);
        } catch (NotFoundPageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        if ($model->load(Yii::$app->request->post())
            && $model->validate()
            && $this->categoryService->updateCategory($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->categoryService->getCategoryById((string)$id);
        } catch (NotFoundPageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        $model->delete();

        return $this->redirect(['index']);
    }

}
