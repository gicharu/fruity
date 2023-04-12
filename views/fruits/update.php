<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fruits $model */

$this->title = 'Update Fruits: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fruits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fruits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
