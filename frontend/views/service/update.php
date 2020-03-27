<?php

use backend\models\forms\CreateImageForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $categories common\models\Service */
/* @var $serviceStatuses common\models\Service */
/* @var $fileForm CreateImageForm */

$this->title = 'Update Service: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 service-update">
            <h1><?php echo Html::encode($this->title) ?></h1>
            <?php echo $this->render('_form', [
                'model' => $model,
                'categories' => $categories
            ]) ?>

        </div>
    </div>
</div>
