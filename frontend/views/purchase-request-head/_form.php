<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelPurchaseRequestHead */
/* @var $form yii\widgets\ActiveForm */


$this->registerJs("
    $(document).ready(function() {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: 'true',
            locale: {
              format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
            }
        })
        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });
    });

    $(document).ready(function() {
        $('#add').click(function() {
          $('#mytable tbody>tr:last').clone(true).insertAfter('#mytable tbody>tr:last');
          return false;
        });
    });
    
");
?>

<style>
    .form-control-xs {
        height: calc(1em + .375rem + 2px) !important;
        padding: .125rem .25rem !important;
        font-size: .75rem !important;
        line-height: 1.5;
        border-radius: .2rem;
    }

    .form-groupx {
        margin-bottom: 0rem;
    }

    .form-groupd {
        margin-bottom: 0rem;
    }
    .rowx {
        margin-top: -1.5rem;
    }
</style>
<div class=" card card-primary">
    <div class="card-header">
        <h3 class="card-title">Input Data</h3>
    </div>
    <div class=" card-body">
        <div class="row rowx">
            <div class="col-md-4">

                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'labelOptions' => ['style' => 'font-size: 10px'],
                    ],
                ]); ?>

                <?= $form->field($model, 'requester_name', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['maxlength' => true, 'class' => 'form-control form-control-xs', 'readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>
                <?= $form->field($model, 'required_date', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs datepicker']) ?>


                <?= $form->field($model, 'department_id', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs']) ?>

                <?= $form->field($model, 'status', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->dropDownList(
                    [1 => 'Enable', 2 => 'Disable'],
                    ['prompt' => '- Select -', 'class' => 'form-control form-control-xs']
                )->label('Status'); ?>

                <!-- <= $form->field($model, 'created_at')->textInput() ?>

            ?= $form->field($model, 'update_at')->textInput() ?>

            <= $form->field($model, 'update_by')->textInput(['maxlength' => true]) ?> -->
                <!-- ['class' => 'form-control form-control-xs'] -->
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'nopr', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['maxlength' => true, 'class' => 'form-control form-control-xs']) ?>
                <?= $form->field($model, 'posting_date', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs datepicker']) ?>

                <?= $form->field($model, 'branch_id', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs']) ?>

                <?php // $form->field($model, 'created_by')->textInput(['maxlength' => true,'class' => 'form-control form-control-xs']) 
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'document_date', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs datepicker']) ?>

                <?= $form->field($model, 'valid_until', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textInput(['class' => 'form-control form-control-xs datepicker']) ?>

                <?= $form->field($model, 'description', [
                    "options" => ["class" => "form-group some-custom-class form-groupx"]
                ])->textarea(['rows' => 0, 'class' => 'form-control form-control-xs']) ?>

            </div>
        </div></br>

        <a id="add">+</a></td>
        <table id="mytable" width="300" border="1" cellspacing="0" cellpadding="2">
            <tbody>
                <tr>
                    <td>Nama Item</td>
                </tr>
                <tr class="person">
                    <td><input type="text" name="name" id="name" /></td>
                </tr>
            </tbody>
        </table>


                </br><div class="row">
            <div class="col-md-12">
                <div class="form-groupd">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>