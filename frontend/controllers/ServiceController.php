<?php

namespace frontend\controllers;

use common\models\Service;
use frontend\models\User;

/**
 * Class ServiceController
 * @package frontend\controllers
 */
class ServiceController extends AppControllers
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $id = \Yii::$app->request->get('id');

        $service = Service::findOne($id);

        return $this->render('index', compact(['service']));
    }
}
