<?php

/* @var $this yii\web\View */
/* @var $serviceModel ServiceController */
/* @var $categories ServiceController */
/* @var $user UserController */

use common\models\ServiceStatusId;
use frontend\controllers\ServiceController;
use frontend\controllers\UserController;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
$currentUser = Html::encode(Yii::$app->user->identity->username);
?>
    <main>
        <div class="container person-cabinet">
            <div class="row">
                <div class="col-md-12">
                    <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                        <ul id="myTabs" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#newservice" role="tab" id="personal-tab"
                                                                      data-toggle="tab"
                                                                      aria-controls="newservice">Create New Service</a>
                            </li>
                            <li role="presentation"><a href="#services" id="services-tab" role="tab"
                                                       data-toggle="tab" aria-controls="services"
                                                       aria-expanded="true">My Services</a></li>
                            <li role="presentation"><a href="#personal" role="tab" id="personal-tab" data-toggle="tab"
                                                       aria-controls="profile">Personal Information</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="newservice"
                                 aria-labelledby="services-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-8 offset-md-2">
                                            <?php echo $this->render('/service/_form', [
                                                'model' => $serviceModel,
                                                'categories' => $categories,
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="services" aria-labelledby="services-tab">
                                <div class="container services-list">
                                    <?php Pjax::begin(['id' => 'services_listing']); ?>
                                    <div class="row">
                                        <?php if (!empty($usersServices)) { ?>
                                            <?php foreach ($usersServices as $service) { ?>
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <?php echo Html::img('/public/imgs/default.jpg', ['alt' => $service->title . ' service']); ?>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo Html::a($service->title, [Url::to(['/service/view', 'id' => $service->id])]); ?></h5>
                                                            <p class="card-text">
                                                                <span class="label label-<?php echo $service->status_id === 9 ? 'danger' : 'success'; ?>">
                                                                    <?php echo ServiceStatusId::STATUS_IDS_MAP[$service->status_id]; ?>
                                                                </span>
                                                            </p>
                                                            <div class="card-price">Price:
                                                                <span><?php echo $service->price ? Yii::$app->formatter->asCurrency($service->price) : 'free'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <p>There is no any service created by
                                                <strong><?php echo $currentUser; ?></strong>!</p>
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
                            <div role="tabpanel" class="tab-pane fade" id="personal" aria-labelledby="personal-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-8 offset-md-2">
                                            <?php echo $this->render('/user/update', [
                                                'model' => $user,
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$js = <<<JS
        $('#myTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    JS;
$this->registerJs($js);
?>