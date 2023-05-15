<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralTransmission */

$this->title = 'Create Transmission';
$this->params['breadcrumbs'][] = ['label' => 'Model Referral Transmissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body model-referral-transmission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
