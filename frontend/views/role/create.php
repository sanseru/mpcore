<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelRole */

$this->title = 'Create Model Role';
$this->params['breadcrumbs'][] = ['label' => 'Model Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
