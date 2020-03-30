<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\components\CategoryService;
use common\repositories\ServiceRepository;
use yii\data\Pagination;


/**
 * Class CategoryController
 * @package frontend\controllers
 */
class CategoryController extends AppControllers
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @var ServiceRepository
     */
    private ServiceRepository $serviceRepository;

    /**
     * CategoryController constructor.
     * @param $id
     * @param $module
     * @param array $config
     * @param CategoryService $categoryService
     */
    public function __construct($id, $module, $config = [], CategoryService $categoryService, ServiceRepository $serviceRepository)
    {
        $this->categoryService = $categoryService;
        $this->serviceRepository = $serviceRepository;

        parent::__construct($id, $module, $config);
    }


    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $pages = new Pagination(['totalCount' => $this->serviceRepository->countServicesByCategoryId($id), 'pageSize' => 8]);
        $services = $this->serviceRepository->getServicesForPaginationByCatId($id, $pages->offset, $pages->limit);
        $category = $this->categoryService->getCategoryById($id);
        return $this->render('view', [
            'services' => $services,
            'pages' => $pages,
            'category' => $category
        ]);
    }
}
