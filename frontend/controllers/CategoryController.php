<?php

namespace frontend\controllers;

use common\models\Service;
use common\components\CategoryService;

/**
 * Class CategoryController
 * @package frontend\controllers
 */
class CategoryController extends AppControllers
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param $id
     * @param $module
     * @param array $config
     * @param CategoryService $categoryService
     */
    public function __construct($id, $module, $config = [], CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $id = \Yii::$app->request->get('id');
        $services = Service::find()->where(['category_id' => $id])->all();
        $category = $this->categoryService->getCategoryById($id);
        return $this->render('index', compact(['services', 'category']));
    }
}
