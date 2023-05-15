<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWarehouseStockOPHead */

$this->title = 'Update Model Warehouse Stock Op Head: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Warehouse Stock Op Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
<div class="card-header">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

