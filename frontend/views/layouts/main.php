<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\PublicAsset;
use common\widgets\Alert;

PublicAsset::register($this);

$getController = Yii::$app->controller;
$templateName = $getController->action->id;
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
        'class' => 'navbar navbar-expand-lg navbar-dark bg-primary',
    ],
]);


$menuItems = [
    ['label' => '+ Service', 'url' => ['/site/addservice'], 'options'=>['class'=>'btn btn-success']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options'=>['class'=>'btn btn-info']];
    $menuItems[] = ['label' => 'Register', 'url' => ['/site/signup'], 'options'=>['class'=>'btn btn-info']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-info logout']
        )
        . Html::endForm()
        . '</li>';
    $menuItems[] = ['label' => 'My Account', 'url' => ['/site/account'], 'options'=>['class'=>'btn btn-info']];
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
<?php
$templateList = ['addservice', 'signup', 'login'];
if(!in_array($templateName, $templateList)) { ?>
    <div class="search-block container">
        <form>
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg" placeholder="Search services...">
                <div class="input-group-append">
                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
<?php } ?>
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
                        <span>33434</span>
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
