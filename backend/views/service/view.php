<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$category = $model->category;

?>
<div class="service-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo DetailView::widget(
        [
            'model' => $model,
            'attributes' => [
                'user.username',
                'status_id',
                'category.title',
                'main_image_name',
                'description:ntext',
                'price',
                'created_time:datetime',
                'updated_time:datetime',
            ],
        ]
    ) ?>

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(
            'Delete',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method'  => 'post',
                ],
            ]
        ) ?>
    </p>

</div>
