<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelPurchaseRequestHead */

$this->title = 'Update Purchase Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Update Purchase Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-purchase-request-head-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
