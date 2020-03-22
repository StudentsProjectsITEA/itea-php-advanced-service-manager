<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $service->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1><?php echo $service->title; ?></h1>
                <p><?php echo $service->description; ?></p>
                <div class="gallary-imgs">
                    <img src="/public/imgs/default.jpg" class="img-thumbnail" alt="..." style="width: 10em;">
                    <img src="/public/imgs/default.jpg" class="img-thumbnail" alt="..." style="width: 10em;">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Author
                    </div>
                    <div class="card-body">
                        <p class="card-text">Name: <span>tester</span></p>
                        <p class="card-text">Surname: <span>testik</span></p>
                        <p class="card-text">Email: <span>testik@ggg.com</span></p>
                        <div href="#" class="btn btn-primary">show phone</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>