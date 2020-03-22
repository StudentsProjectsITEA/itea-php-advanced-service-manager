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

    public function init()
    {
        parent::init();
        $this->classParams;
    }

    public function run()
    {
        $allCategories = \Yii::$container->get(CategoryService::class);
        $this->data = $allCategories->getCategories()->all();
        $this->html = $this->getCategoryListHtml($this->data);
        return $this->html;
    }

    public function getCategoryListHtml($categories)
    {
        $str = '';
        foreach ($categories as $cat) {
            $str .= Html::a($cat->title, [Url::to(['/category', 'id' => $cat->id])], ['class'=>$this->classParams]);
        }
        return $str;
    }
}
