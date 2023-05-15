<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWarehouseStockOPHead */

$this->title = $model->tanggal_mulai;
$this->params['breadcrumbs'][] = ['label' => 'Model Warehouse Stock Op Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="model-warehouse-stock-ophead-view">

    <h1>Stock Opname Start Date <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idStockOP',
            'gudang',
            'tanggal_mulai',
            'keterangan:ntext',
            'status',
            'createdBy',
            'createdTime',
            'ModifiedBy',
            'ModifiedTime',
        ],
    ]) ?>

</div>
