<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWarehouseStockOPHead */

$this->title = 'Create Stock Opname';
$this->params['breadcrumbs'][] = ['label' => 'Model Warehouse Stock Op Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
