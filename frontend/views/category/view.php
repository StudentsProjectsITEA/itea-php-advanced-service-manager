<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use \frontend\components\CategoryMenuWidget;
use yii\widgets\LinkPager;
use common\models\ServiceStatusId;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = Html::encode($category->title);
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center mb-5">
                <h1><?php echo Html::encode($category->title); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h2>Categories</h2>
                <div class="list-group category-links">
                    <?php echo CategoryMenuWidget::widget(['classParams' => 'list-group-item']); ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="services-list">
                    <?php Pjax::begin(['id' => 'category_services_listing']); ?>
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php if (!empty($services)) { ?>
                            <?php foreach ($services as $service) { ?>
                                <div class="col mb-4">
                                    <div class="card">
                                        <?php echo Html::img('/public/imgs/default.jpg', ['alt' => $category->title . ' service']); ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo Html::a($service->title, [Url::to(['/service/view', 'id' => $service->id])]); ?></h5>
                                            <p class="card-text">
                                                <span class="label label-<?php echo $service->status_id === 9 ? 'danger' : 'success'; ?>">
                                                    <?php echo ServiceStatusId::STATUS_IDS_MAP[$service->status_id]; ?>
                                                </span>
                                            </p>
                                            <div class="card-price">Price:
                                                <span><strong><?php echo $service->price ? Yii::$app->formatter->asCurrency($service->price) : 'free'; ?></strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>There is no any service in this category!</p>
                        <?php } ?>
                    </div>
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);

                    Pjax::end();
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="content-pages">
                    <?php echo HtmlPurifier::process($category->description); ?>
                </div>
            </div>
        </div>
    </div>

</main>