<?php

use app\models\Favourites;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Favourites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favourites-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'nutritions.carbohydrates',
            'nutritions.protein',
            'nutritions.fat',
            'nutritions.calories',
            'nutritions.sugar',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, \app\models\Fruits $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{delete}'
            ],
        ],
    ]); ?>


</div>
