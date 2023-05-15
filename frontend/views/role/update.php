<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelRole */

$this->title = 'Update Model Role: ' . $model->idrole;
$this->params['breadcrumbs'][] = ['label' => 'Model Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrole, 'url' => ['view', 'id' => $model->idrole]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
