<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Service App';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="category-list d-flex">
                <?php echo Html::a('category', ['/site/category'], ['class'=>'btn btn-primary']) ?>
                <a href="/site/category" class="btn btn-primary">category 1</a>
                <a href="/site/category" class="btn btn-primary">category 2</a>
                <a href="/site/category" class="btn btn-primary">category 3</a>
            </div>
        </div>
    </div>
    <div class="container services-list">
        <div class="row row-cols-1 row-cols-md-4">
            <div class="col mb-4">
                <div class="card">
                    <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card">
                    <img src="/public/imgs/default.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>