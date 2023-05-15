<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModeWhAssetAlkes */

$this->title = 'New Alkes';
$this->params['breadcrumbs'][] = ['label' => 'Mode Wh Asset Alkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mode-wh-asset-alkes-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
