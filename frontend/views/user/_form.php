<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'avatar_name')->fileInput() ?>

    <?php echo $form->field($model, 'mobile')->widget(
        \yii\widgets\MaskedInput::class,
        [
            'mask' => '(999) 999-99-99',
            'clientOptions' => [
                'removeMaskOnSubmit' => true,
            ]
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
