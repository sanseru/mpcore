<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWarehouseStockOPHeadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-warehouse-stock-ophead-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idStockOP') ?>

    <?= $form->field($model, 'gudang') ?>

    <?= $form->field($model, 'tanggal_mulai') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'ModifiedBy') ?>

    <?php // echo $form->field($model, 'ModifiedTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
