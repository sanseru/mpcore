<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelPurchaseRequestHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="model-purchase-request-head-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'requester_name',
            'branch_id',
            'department_id',
            'nopr',
            'status',
            'posting_date',
            'required_date',
            'created_by',
            'created_at',
            'update_at',
            'update_by',
            'description:ntext',
            'valid_until',
            'document_date',
        ],
    ]) ?>

</div>
