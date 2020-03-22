<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use \frontend\components\CategoryMenuWidget;

$this->params['breadcrumbs'][] = $category->title;
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center mb-5">
                <h1><?php echo $category->title; ?></h1>
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
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php if (!empty($services)) { ?>
                            <?php foreach ($services as $service) { ?>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo Html::a($service->title, [Url::to(['/service', 'id' => $service->id])]); ?></h5>
                                            <p class="card-text"><?php echo $service->description; ?></p>
                                            <div class="card-price">Price: <span><?php echo $service->price; ?> UAH</span></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>There is no any service in this category!</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo $category->description; ?>
            </div>
        </div>
    </div>

</main>