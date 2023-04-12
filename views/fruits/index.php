<?php

use app\models\Fruits;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FruitsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Fruits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fruits-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fruits', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::class,
                'template' => '{favourite}',
                'buttons' => [
                    'favourite' => function ($url, $model, $key) {
                        return \yii\bootstrap5\Html::a('*', $url, [
                            'title' => 'Add to favourites',
                            'class' => 'btn btn-default'
                        ]);
                    }
                ],
                'urlCreator' => function ($action, Fruits $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
//            'id',
            'name',
            'genus',
            'family',
            'order',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fruits $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
