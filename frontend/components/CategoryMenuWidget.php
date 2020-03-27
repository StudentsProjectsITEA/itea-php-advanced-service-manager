<?php

namespace frontend\components;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\Widget;
use common\components\CategoryService;

/**
 * Class CategoryMenuWidget
 * @package frontend\components
 */
class CategoryMenuWidget extends Widget
{
    public $data;
    public $html;
    public $classParams;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService, $config = [])
    {
        parent::__construct($config);
        $this->categoryService = $categoryService;
    }

    public function init()
    {
        parent::init();
        $this->classParams;
    }

    public function run()
    {
        $this->html = $this->getCategoryListHtml($this->categoryService->getCategoriesList());
        return $this->html;
    }

    /**
     * @param $categories
     * @return string
     */
    public function getCategoryListHtml($categories)
    {
        $str = '';
        foreach ($categories as $cat) {
            $str .= Html::a($cat->title, [Url::to(['/category/view', 'id' => $cat->id])], ['class' => $this->classParams]);
        }
        return $str;
    }
}
