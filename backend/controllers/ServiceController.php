<?php

declare(strict_types=1);

namespace backend\controllers;

use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Service;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;
use common\components\ServiceService;
use common\models\search\ServiceSearch;
use common\exceptions\NotFoundPageException;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{

    /**
     * @var ServiceService
     */
    private ServiceService $serviceService;

    /**
     * ServiceController constructor.
     *
     * @param $id
     * @param $module
     * @param ServiceService $serviceService
     * @param array $config
     */
    public function __construct($id, $module, ServiceService $serviceService, $config = [])
    {
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
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Service models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $serviceStatuses = $this->serviceService->statusesDropdownList();
        $categoriesDropdownList =  $this->serviceService->getCategoriesFilterList();
        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'serviceStatuses' => $serviceStatuses,
                'categoriesDropdownList' => $categoriesDropdownList,
            ]
        );
    }

    /**
     * Displays a single Service model.
     *
     * @param string $id
     *
     * @return mixed
     * @throws InvalidConfigException
     */
    public function actionView($id)
    {
        $model = $this->serviceService->getServiceById($id);
        $model->status_id = $this->serviceService->getStatusLabel($model->status_id);
        $model->price  = \Yii::$app->formatter->asCurrency($model->price, 'UAH');

        return $this->render(
            'view',
            [
                'model' => $model,
            ]
        );
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

        if (
            $model->load(Yii::$app->request->post())
            && $model->validate()
            && $this->serviceService->updateService($model)
        ) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->serviceStatuses = $this->serviceService->getStatusesIds();
        $categoriesDropdown = $this->serviceService->getCategoriesList();

        return $this->render(
            'update',
            [
                'model' => $model,
                'categories' => $categoriesDropdown,
            ]
        );
    }

    /**
     * Deletes an existing Service model.
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
            $model = $this->serviceService->getServiceById($id);
        } catch (NotFoundPageException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
