<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModeWhAssetAlkesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mode-wh-asset-alkes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codeAset') ?>

    <?= $form->field($model, 'noAsset_SAP') ?>

    <?= $form->field($model, 'noInventory') ?>

    <?= $form->field($model, 'namaAlat') ?>

    <?php // echo $form->field($model, 'merk') ?>

    <?php // echo $form->field($model, 'tipe') ?>

    <?php // echo $form->field($model, 'noSeri') ?>

    <?php // echo $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'tglBeli') ?>

    <?php // echo $form->field($model, 'tglKalibrasi') ?>

    <?php // echo $form->field($model, 'Supplier') ?>

    <?php // echo $form->field($model, 'kondisi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
