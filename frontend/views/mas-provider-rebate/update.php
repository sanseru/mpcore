<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMasProviderRebate */

$this->title = 'Update Model Mas Provider Rebate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Mas Provider Rebates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-mas-provider-rebate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
