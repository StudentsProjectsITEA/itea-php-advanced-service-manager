<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \frontend\models\User */
/* @var $modelForm frontend\models\forms\UserForm */

?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelForm' => $modelForm,
    ]) ?>

</div>
