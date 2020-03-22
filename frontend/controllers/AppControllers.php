<?php

namespace frontend\controllers;

use yii\web\Controller;

class AppControllers extends Controller
{
    /**
     * @param string $title
     * @param string $description
     */
    protected function setMeta(string $title, string $description): void
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
    }
}
