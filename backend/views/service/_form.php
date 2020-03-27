<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
/* @var $statusesIds common\models\Service */
/* @var $categories common\models\Service */

?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'status_id')->dropdownList((array) $model->serviceStatuses); ?>

    <?php echo $form->field($model, 'category_id')->dropdownList((array) $categories); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
