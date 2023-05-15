<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWhgudang */

$this->title = 'Create Model Whgudang';
$this->params['breadcrumbs'][] = ['label' => 'Model Whgudangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-whgudang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
