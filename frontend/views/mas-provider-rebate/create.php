<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMasProviderRebate */

$this->title = 'Create Model Mas Provider Rebate';
$this->params['breadcrumbs'][] = ['label' => 'Model Mas Provider Rebates', 'url' => ['index']];
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
