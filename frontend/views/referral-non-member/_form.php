<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralNonMemberLog */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
function lookupGl(){
    tableApiServerSide('.gls','../api/get-glmas');        
}
", VIEW::POS_HEAD);

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
    
");

$this->registerJs("
$(document).on(\"click\", \".addgl\", function () {		
        
    var data = $(this).data('id');
    data =  data.split(';');
    $('#no_gl_numbers').val(data[0]);
    $('#nama_rs').val(data[1]);
    $('#nama_peserta').val(data[2]);
    $('#client').val(data[3]);

    $('.gl-search').modal('hide')
})");

$this->registerCss("
    .search, .addgl{
        cursor:pointer;
    }
");
?>

<div class=" card card-primary">
    <div class="card-header">
        <h3 class="card-title">Input Data</h3>
    </div>
    <div class=" card-body">
        <div class="row">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'tanggal_terima_berkas')->textInput(['class' => 'form-control datepicker']) ?>

                <?= $form->field($model, 'tanggal_periksa')->textInput(['class' => 'form-control datepicker']) ?>

                <?= $form->field($model, 'no_gl', [
                    'template' => '{label}<div class="input-group mb-12">{input}
            <div class="input-group-append">
            <span class="input-group-text search"><i class="fas fa-search" aria-hidden="true" data-toggle="modal" data-target=".gl-search" onClick="lookupGl();"></i></span>
            </div></div>{error}{hint}'
                ])->textInput(['maxlength' => true, 'id' => 'no_gl_numbers']) ?>

                <?= $form->field($model, 'nama_peserta')->textInput(['maxlength' => true, 'id' => 'nama_peserta']) ?>

                <?= $form->field($model, 'client')->textInput(['maxlength' => true, 'id' => 'client']) ?>

                <?= $form->field($model, 'nama_rs')->textInput(['maxlength' => true, 'id' => 'nama_rs']) ?>

                <?= $form->field($model, 'no_invoice')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'covteq')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'jalur_pembuatan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jumlah')->textInput() ?>

                <?= $form->field($model, 'link_dokumen_invoice')->textarea(['rows' => 3]) ?>

                <?php //$form->field($model, 'document_file')->textarea(['rows' => 6]) 
                ?>
                <?= $form->field($model, 'document_file[]')->fileInput(['multiple' => true, 'accept' => 'application/pdf']) ?>

                <?= $form->field($model, 'tanggal_input_link_document')->textInput(['class' => 'form-control datepicker']) ?>

                <?= $form->field($model, 'tanggal_kirim_dokument_ar_ap')->textInput(['class' => 'form-control datepicker']) ?>

                <?= $form->field($model, 'remarks_tim_billing')->textarea(['rows' => 3]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>




<!-- ------------ /MODAL ------------------>
<div class="modal fade gl-search" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Search gl</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered gls" id="glid" style="width:100%">
                        <thead>
                            <tr>
                                <th>Case Gl</th>
                                <th>No Gl</th>
                                <th>Provider</th>
                                <th>Nama Peserta</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ------------------>