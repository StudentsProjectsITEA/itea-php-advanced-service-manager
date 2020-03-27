<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\ServiceStatusId;
use backend\controllers\ServiceController;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $serviceStatuses ServiceController */
/* @var $categoriesDropdownList ServiceController */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?php echo $this->render('_search',
                             [
                                 'model' => $searchModel,
                                 'serviceStatuses' => $serviceStatuses,
                                 'categoriesDropdownList' => $categoriesDropdownList,
                             ]
    ); ?>

    <?php echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'category.title',
                [
                    'attribute' => 'status_id',
                    'label' => 'Status',
                    'filter' => $serviceStatuses,
                    'value' => function ($model) {
                       return ServiceStatusId::STATUS_IDS_MAP[$model->status_id];
                    },
                ],
                'user.username',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>

    <?php Pjax::end(); ?>

</div>