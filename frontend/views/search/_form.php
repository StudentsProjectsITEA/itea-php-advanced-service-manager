<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\SearchForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\models\SearchForm */

$model = new SearchForm();
?>

<?php $form = ActiveForm::begin(
    [
        'action' => ['search/index'],
        'method' => 'get',
    ]
) ?>
    <div class="input-group mb-3 search-form-group">
        <?php echo $form->field($model, 'search')->textInput(['class' => 'form-control form-control-lg'])->label(''); ?>
        <div class="input-group-append">
            <?php echo Html::submitButton('Search', ['class' => 'btn btn-lg btn-ico btn-secondary btn-minimal']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>