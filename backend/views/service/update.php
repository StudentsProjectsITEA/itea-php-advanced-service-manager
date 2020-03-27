<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $categories common\models\Service */
/* @var $serviceStatuses common\models\Service */

$this->title = 'Update Service: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
