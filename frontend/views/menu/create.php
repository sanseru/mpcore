<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMenu */

$this->title = 'Create Model Menu';
$this->params['breadcrumbs'][] = ['label' => 'Model Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
