<?php

use backend\controllers\ServiceController;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ServiceSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $serviceStatuses ServiceController */
/* @var $categoriesDropdownList ServiceController */

?>

<div class="service-search">

    <?php $form = ActiveForm::begin(
        [
            'action'  => ['index'],
            'method'  => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]
    ); ?>

    <div class="row">
        <div class="col-xs-6">
            <?php echo $form->field($model, 'title'); ?>
        </div>
        <div class="col-xs-2">
            <?php echo $form->field($model, 'status_id')->dropDownList((array)$serviceStatuses); ?>
        </div>
        <div class="col-xs-2">
            <?php echo $form->field($model, 'category_id')->dropDownList((array)$categoriesDropdownList); ?>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <br>
                <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?php echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
