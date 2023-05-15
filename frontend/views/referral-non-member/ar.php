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
$encFile = Yii::getAlias('@webroot/inc/table.php');
require_once($encFile);
?>
<div class=" card card-block">
    <div class=" card-body">
        <?= TableReff($model->id); ?>
    </div>
</div>

<div class=" card card-warning">
    <div class="card-header">
        <h3 class="card-title">Input Data AR</h3>
    </div>
    <div class=" card-body">
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'nomer_ar')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'remarks_tim_ar')->textarea(['rows' => 3]) ?>

                <input type="checkbox" id="nomer_so" name="nomer_so">
                <label for="vehicle1"> Update Semua No SO Ini</label><br>

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