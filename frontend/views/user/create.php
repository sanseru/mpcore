<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelUser */

$this->title = 'Create Model User';
$this->params['breadcrumbs'][] = ['label' => 'Model Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-user-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
