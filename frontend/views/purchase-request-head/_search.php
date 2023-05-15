<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelPurchaseRequestHeadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-purchase-request-head-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requester_name') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'nopr') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'posting_date') ?>

    <?php // echo $form->field($model, 'required_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'valid_until') ?>

    <?php // echo $form->field($model, 'document_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
