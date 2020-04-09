<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <div class="site-signup">
                    <h1><?php echo Html::encode($this->title) ?></h1>

                    <p>Please fill out the following fields to signup:</p>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?php echo $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?php echo $form->field($model, 'email') ?>

                    <?php echo $form->field($model, 'mobile')->widget(\yii\widgets\MaskedInput::class,
                        ['mask' => '+NN(9N9)999-99-99',
                            'clientOptions' => [
                                'removeMaskOnSubmit' => true,
                            ],
                            'definitions' => [
                                'N' => [
                                    'validator' =>  '^[1-9]+',
                                ]
                            ]
                        ]); ?>

                    <?php echo $form->field($model, 'password')->passwordInput() ?>

                    <div class="form-group">
                        <?php echo Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
