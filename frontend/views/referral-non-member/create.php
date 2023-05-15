<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralNonMemberLog */

$this->title = 'Referral Non Member';
$this->params['breadcrumbs'][] = ['label' => 'Referral Non Member', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="model-referral-non-member-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
