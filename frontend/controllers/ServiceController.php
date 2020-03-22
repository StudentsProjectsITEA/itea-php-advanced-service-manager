<?php

namespace frontend\controllers;

use common\models\Service;

class ServiceController extends AppControllers
{
    public function actionIndex()
    {
        $id = \Yii::$app->request->get('id');

        $service = Service::findOne($id);

        return $this->render('index', compact(['service']));
    }
}