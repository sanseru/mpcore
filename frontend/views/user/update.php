<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelUser */

$this->title = 'Update Model User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-user-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
