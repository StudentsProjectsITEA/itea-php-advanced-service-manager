<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\ServiceStatusId;

?>
<div class="col-md-3">
    <div class="card">
        <?php echo Html::img('/public/imgs/default.jpg', ['alt' => $model->title . ' service']); ?>
        <div class="card-body">
            <h5 class="card-title"><?php echo Html::a($model->title, [Url::to(['/service/view', 'id' => $model->id])]); ?></h5>
            <p class="card-text">
                <span class="label label-<?php echo $model->status_id === 9 ? 'danger' : 'success'; ?>">
                    <?php echo ServiceStatusId::STATUS_IDS_MAP[$model->status_id]; ?>
                </span>
            </p>
            <div class="card-price">Price:
                <span><strong><?php echo Yii::$app->formatter->asCurrency($model->price); ?></strong></span>
            </div>
        </div>
    </div>
</div>
