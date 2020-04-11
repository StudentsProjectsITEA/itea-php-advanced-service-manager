<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->params['breadcrumbs'][] = Html::encode($currentService->title);
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1><?php echo Html::encode($currentService->title); ?></h1>
                <div class="content-pages">
                    <div class="well well-sm">Price: <?php echo $currentService->price; ?></div>
                    <div class="well well-sm">Category: <?php echo $currentService->category->title; ?></div>
                    <?php if ($currentService->main_image_name) { ?>
                        <img src="<?php echo $currentService->getImagePath(); ?>" class="img-thumbnail" alt="..." style="width: 20em; float: left; margin: 5px 10px 0 0">
                    <?php } ?>
                    <?php echo HtmlPurifier::process($currentService->description); ?>
                </div>
                <div>
                    <?php
                    if ($currentService->user_id === Yii::$app->user->id) {
                        echo Html::a('EDIT', ['service/update', 'id' => $currentService->id], ['class'=>'btn btn-primary']);
                        echo Html::a('DELETE', ['service/delete', 'id' => $currentService->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this service?',
                                'method' => 'post',
                            ],
                        ]);
                    } ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Author
                    </div>
                    <div class="card-body">
                        <p class="card-text">Name: <span><?php echo Html::encode($currentUser->username); ?></span></p>
                        <p class="card-text">Email: <span><?php echo Html::encode($currentUser->email); ?></span></p>
                        <p class="card-text"><?php echo Yii::$app->formatter->asPhone($currentUser->mobile); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>