<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelSerahterimaassetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-serahterimaasset-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'User_Name') ?>

    <?= $form->field($model, 'Host_Name') ?>

    <?= $form->field($model, 'Manufacturer') ?>

    <?= $form->field($model, 'Services_Tag') ?>

    <?php // echo $form->field($model, 'Vesion_Product') ?>

    <?php // echo $form->field($model, 'Status_Aset') ?>

    <?php // echo $form->field($model, 'Project') ?>

    <?php // echo $form->field($model, 'Location') ?>

    <?php // echo $form->field($model, 'Addon_Item') ?>

    <?php // echo $form->field($model, 'Date_Asset') ?>

    <?php // echo $form->field($model, 'Created_Time') ?>

    <?php // echo $form->field($model, 'Created_By') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
