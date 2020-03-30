<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use \frontend\components\CategoryMenuWidget;
use yii\helpers\Url;
use common\models\ServiceStatusId;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Service App';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="category-list d-flex">
                <?php echo CategoryMenuWidget::widget(['classParams' => 'btn btn-primary']); ?>
            </div>
        </div>
    </div>
    <div class="container services-list">
        <?php Pjax::begin(['id' => 'homepage_listing']); ?>
        <div class="row row-cols-1 row-cols-md-4">
            <?php if (!empty($allServices)) { ?>
                <?php foreach ($allServices as $service) { ?>
                    <div class="col mb-4">
                        <div class="card">
                            <?php echo Html::img(
                                $service->main_image_name ? $service->main_image_name : '/public/imgs/default.jpg',
                                ['alt' => $service->title]
                            ); ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo Html::a(
                                        $service->title,
                                        [
                                            Url::to(
                                                [
                                                    '/service/view',
                                                    'id' => $service->id
                                                ]
                                            )
                                        ]
                                    ); ?></h5>
                                <p class="card-text">
                                    <span class="label label-<?php echo $service->status_id === 9 ? 'danger' : 'success'; ?>">
                                        <?php echo ServiceStatusId::STATUS_IDS_MAP[$service->status_id]; ?>
                                    </span>
                                </p>
                                <div class="card-price">Price:
                                    <span><strong><?php echo $service->price ? Yii::$app->formatter->asCurrency(
                                                $service->price
                                            ) : 'free'; ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>There is no any service in this category!</p>
            <?php } ?>
        </div>
        <?php echo LinkPager::widget(
            [
                'pagination' => $pages,
            ]
        );
        Pjax::end();
        ?>
    </div>
</main>