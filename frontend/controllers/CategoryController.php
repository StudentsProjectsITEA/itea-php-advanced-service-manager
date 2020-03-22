<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Service;
use Yii;

class CategoryController extends AppControllers
{
    public function actionIndex($id)
    {
        $id = \Yii::$app->request->get('id');
        $services = Service::find()->where(['category_id' => $id])->all();
        $category = Category::findOne($id);
        return $this->render('index', compact(['services', 'category']));
    }
}
