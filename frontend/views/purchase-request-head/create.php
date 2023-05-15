<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelPurchaseRequestHead */

$this->title = 'Create Purchase Request';
$this->params['breadcrumbs'][] = ['label' => 'Create Purchase Request', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$('#control_sidebar').addClass('sidebar-collapse');
$('[data-toggle=\"tooltip\"]').tooltip();

");
?>
<div class="model-purchase-request-head-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
