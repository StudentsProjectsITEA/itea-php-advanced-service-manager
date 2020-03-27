<?php

use http\Url;
use yii\bootstrap\Button;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $status backend\controllers\CategoryController */
/* @var $notice backend\controllers\CategoryController */

$this->title                   = 'Notice';
$this->params['breadcrumbs'][] = 'Notice';
?>
<div class="category-update">
    <h1><?php echo $status; ?></h1>
    <p><?php echo $notice; ?></p>
    <p><?php echo Html::a('Назад', ['/category/index'], ['class'=>'btn btn-primary']) ?></p>
</div>
