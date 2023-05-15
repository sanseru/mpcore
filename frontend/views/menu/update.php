<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMenu */

$this->title = 'Update Model Menu: ' . $model->idmenu;
$this->params['breadcrumbs'][] = ['label' => 'Model Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmenu, 'url' => ['view', 'id' => $model->idmenu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
