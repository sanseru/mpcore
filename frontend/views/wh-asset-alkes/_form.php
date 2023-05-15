<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModeWhAssetAlkes */
/* @var $form yii\widgets\ActiveForm */
// $this->registerJs("$('#control_sidebar').addClass('sidebar-collapse');");
$this->registerJs("
    $(document).ready(function() {
        $('.datex').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: 'true',
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
            }
          }, function (chosen_date) {
            $(this.element[0]).val(chosen_date.format('YYYY-MM-DD'));
        })
    });
    
");
?>

<div class="col-12 col-sm-8 col-md-6 col-lg-12">
    <div class="card">
        <div class="card-header">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'codeAset')->textInput(['maxlength' => true, 'class' => 'form-control ', 'readOnly' => 'true']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'noAsset_SAP')->textInput(['maxlength' => true]) ?>

                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'noInventory')->textInput(['maxlength' => true, 'disabled' => 'true']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'namaAlat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'merk')->textInput(['maxlength' => true, 'autocomplete' => 'on']) ?>

                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'tipe')->textInput(['maxlength' => true, 'autocomplete' => 'on']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'noSeri')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true, 'autocomplete' => 'on']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'tglBeli')->textInput(['class' => 'form-control datex','autocomplete' => 'off']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'tglKalibrasi')->textInput(['class' => 'form-control datex','autocomplete' => 'off']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'tglexpKalibrasi')->textInput(['class' => 'form-control datex','autocomplete' => 'off']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Supplier')->textInput(['maxlength' => true, 'autocomplete' => 'on']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'kondisi')->textInput(['maxlength' => true, 'autocomplete' => 'on']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'pic1')->fileInput() ?>

                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'pic2')->fileInput() ?>


                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>