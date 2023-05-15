<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMenu */

$this->title = $model->nama_menu;
$this->params['breadcrumbs'][] = ['label' => 'Model Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
<div class="card card-header">

    <!-- <h4><?= Html::encode($this->title) ?></h4> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idmenu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idmenu], [
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
            'idmenu',
            'nama_menu',
            'link',
            'flag',
            'icon',
        ],
    ]) ?>

</div>
</div>

