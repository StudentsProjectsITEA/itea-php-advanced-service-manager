<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \frontend\models\User */
/* @var $modelForm frontend\models\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="user-avatar">
        <img src="<?= $model->getImagePath() ?>" alt="" width="300">
    </div>

    <?php echo $form->field($modelForm, 'eventImage')->fileInput()->label('Avatar') ?>

    <?php echo $form->field($modelForm, 'mobile')->widget(
        \yii\widgets\MaskedInput::class,
        [
            'mask' => '+NN(9N9)999-99-99',
            'clientOptions' => [
                'removeMaskOnSubmit' => true,
            ],
            'definitions' => [
                'N' => [
                    'validator' =>  '^[1-9]+',
                ]
            ]
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
