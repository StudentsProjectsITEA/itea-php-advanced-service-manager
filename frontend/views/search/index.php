<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Search page';
$this->params['breadcrumbs'][] = $this->title;

?>

<main>
    <div class="container search-page">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo Html::encode($this->title) ?></h1>
            </div>
        </div>
        <div class="row">
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper search-list',
                    'id' => 'list-wrapper',
                ],
                'layout' => "{pager}\n{items}\n{summary}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_list_item', ['model' => $model]);
                },
            ]); ?>
        </div>
    </div>
</main>