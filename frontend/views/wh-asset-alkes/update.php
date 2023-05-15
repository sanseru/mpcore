<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModeWhAssetAlkes */

$this->title = 'Update Mode Wh Asset Alkes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mode Wh Asset Alkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mode-wh-asset-alkes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
