<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <?php echo Html::encode($this->title) ?>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?php echo $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?php echo $form->field($model, 'password')->passwordInput() ?>

                        <?php echo $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="color:#999;margin:1em 0">
                            If you forgot your password you
                            can <?php echo Html::a('reset it', ['site/request-password-reset']) ?>.
                            <br>
                            Need new verification email? <?php echo Html::a('Resend', ['site/resend-verification-email']) ?>
                        </div>

                        <div class="form-group">
                            <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>