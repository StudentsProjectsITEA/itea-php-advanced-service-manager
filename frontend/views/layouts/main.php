<?php

/* @var $this \yii\web\View */

/* @var $content string */
/* @var $model frontend\models\SearchForm */
/* @var $querySearch frontend\controllers\SearchController */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\PublicAsset;
use common\widgets\Alert;
use frontend\components\TotalServicesWidget;

PublicAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- NAVBAR -->
<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'service-app-menu navbar navbar-expand-lg navbar-dark bg-primary',
    ],
]);

if (Yii::$app->user->isGuest) {
    $menuItems = [
        ['label' => '+ Service', 'url' => ['/site/login'], 'options' => ['class' => 'btn btn-success']],
    ];
} else {
    $menuItems = [
        ['label' => '+ Service', 'url' => ['/account', 'id' => Yii::$app->user->id], 'options' => ['class' => 'btn btn-success']],
    ];
}


if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options' => ['class' => 'btn btn-info']];
    $menuItems[] = ['label' => 'Register', 'url' => ['/site/signup'], 'options' => ['class' => 'btn btn-info']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-info logout']
        )
        . Html::endForm()
        . '</li>';
    $menuItems[] = Html::a('My Account', [Url::to(['/account', 'id' => Yii::$app->user->id])], ['class' => 'btn btn-info']);
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>
<!-- END NAVBAR -->
<!-- BREADCRUMBS -->
<div class="container">
    <?php echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?php echo Alert::widget() ?>
</div>
<!-- END BREADCRUMBS -->
<!-- SEARCH BLOCK -->
<div class="search-block container">
    <?php echo $this->render('/search/_form', []); ?>
</div>
<!-- END SEARCH BLOCK -->
<!-- MAIN BLOCK -->
<?php echo $content; ?>
<!-- END MAIN BLOCK -->
<!-- FOOTER -->
<footer>
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col-4">
                <div class="footer__copyright">
                    &copy; <?php echo Html::encode(Yii::$app->name) ?> <?php echo date('Y') ?></div>
            </div>
            <div class="col-8">
                <div class="d-flex align-items-center justify-content-end">
                    <?php
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Terms', 'url' => ['/site/terms']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                    ];
                    echo Nav::widget([
                        'options' => ['class' => 'nav footer__menu'],
                        'items' => $menuItems,
                    ]);

                    ?>
                    <div class="footer__total--services">
                        <span>Services: </span>
                        <span><?php echo TotalServicesWidget::widget(); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
