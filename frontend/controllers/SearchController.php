<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\search\ServiceSearch;
use common\repositories\ServiceRepository;
use yii\data\ActiveDataProvider;
use frontend\models\SearchForm;
use yii\helpers\Html;

/**
 * Class SearchController
 * @package frontend\controllers
 */
class SearchController extends AppControllers
{

    /**
     * @var ServiceSearch
     */
    public ServiceSearch $serviceSearch;
    /**
     * @var ServiceRepository
     */
    public ServiceRepository $serviceRepository;

    /**
     * SearchController constructor.
     * @param $id
     * @param $module
     * @param array $config
     * @param ServiceSearch $serviceSearch
     * @param ServiceRepository $serviceRepository
     */
    public function __construct($id, $module, $config = [], ServiceSearch $serviceSearch, ServiceRepository $serviceRepository)
    {
        $this->serviceSearch = $serviceSearch;
        $this->serviceRepository = $serviceRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param \yii\base\Action $action
     * @return bool|\yii\web\Response
     */
    public function beforeAction($action)
    {
        $model = new SearchForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $search = Html::encode($model->search);

            return $this->redirect(\Yii::$app->urlManager->createUrl(['search/index', 'search' => $search]));
        }
        return true;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new SearchForm();
        $dataProvider = new ActiveDataProvider([
            'query' => $this->serviceRepository->searchServiceByTitle(\Yii::$app->request->queryParams["SearchForm"]["search"]),
        ]);
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
