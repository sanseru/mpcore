<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelSerahterimaasset */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Serahterimaassets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="model-serahterimaasset-view">

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
            'User_Name',
            'Host_Name',
            'Manufacturer',
            'Services_Tag',
            'Vesion_Product',
            'Status_Aset',
            'Project',
            'Location',
            'Addon_Item:ntext',
            'Date_Asset',
            'Created_Time',
            'Created_By',
        ],
    ]) ?>

</div>
