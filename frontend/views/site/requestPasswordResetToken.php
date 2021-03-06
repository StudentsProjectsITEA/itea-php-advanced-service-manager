<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <div class="site-request-password-reset">
                    <h1><?php echo Html::encode($this->title) ?></h1>

                    <p>Please fill out your email. A link to reset password will be sent there.</p>

                    <div class="row">
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                            <?php echo $form->field($model, 'email')->textInput(['autofocus' => true]); ?>

                            <div class="form-group">
                                <?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
