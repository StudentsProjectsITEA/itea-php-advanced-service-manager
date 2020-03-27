<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = 'WELCOME TO SERVICE ADMIN PANEL';
?>
<div class="site-index">
    <div class="jumbotron">
        <div class="jumbotron">
            <h2><?php echo $this->title ?></h2>
            <h3>moderate it</h3>
            <?php echo Html::a('SERVICES', ['/service/index'], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('CATEGORIES', ['/category/index'], ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('USERS', ['/user/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
