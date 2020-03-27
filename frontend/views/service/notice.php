<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $status backend\controllers\CategoryController */
/* @var $notice backend\controllers\CategoryController */
/* @var $backLink backend\controllers\CategoryController */

$this->title = 'Notice';
$this->params['breadcrumbs'][] = 'Notice';
?>
<div class="container">
    <div class="notice">
        <h1><?php echo $status; ?></h1>
        <p><?php echo $notice; ?></p>
        <p><?php echo Html::a('Back', [$backLink], ['class'=>'btn btn-primary']) ?></p>
    </div>
</div>
