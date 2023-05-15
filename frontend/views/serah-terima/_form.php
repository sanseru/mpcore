<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelSerahterimaasset */
/* @var $form yii\widgets\ActiveForm */


$this->registerJs("
    $(document).ready(function() {
        $('.datetime1').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
              format: 'YYYY-MM-DD'
            }
          })
    });

    $(document).on(\"click\", \".cari\", function () {	
        tableApi('.datatable','api/cariserahterima');
    });

    $(document).on(\"click\", \".add\", function () {	
        $('.sasset').modal('hide');
        var key_ = $(this).data('id');
        var key_2 = $(this).data('id2');	            

        var myarr = key_.split(';');
        var myarr2 = key_2.split(';');

        
        document.getElementById(\"User_Name\").value = myarr[0];
        document.getElementById(\"Host_Name\").value = myarr[1];
        document.getElementById(\"Manufacturer\").value = myarr[2];
        document.getElementById(\"Services_Tag\").value = myarr2[0];
        document.getElementById(\"Vesion_Product\").value = myarr2[1];
    
    });
    
");


?>

<div class="card">
<div class="card-header">
    <?php $form = ActiveForm::begin(); ?>
    <button type="button" class="btn btn-primary btn-xs cari" data-toggle="modal" data-target=".sasset" title="Search Asset"><i class="fas fa-barcode"></i> Search</button>
    <div class="row">
        <div class="col-4">
        <?= $form->field($model, 'User_Name')->textInput(['maxlength' => true,'id'=>'User_Name']) ?>
        </div>
        <div class="col-2">
        <?= $form->field($model, 'Host_Name')->textInput(['maxlength' => true,'id'=>'Host_Name']) ?>
        </div>
        <div class="col-2">
        <?= $form->field($model, 'Manufacturer')->textInput(['maxlength' => true,'id'=>'Manufacturer']) ?>
        </div>
        <div class="col-2">
        <?= $form->field($model, 'Services_Tag')->textInput(['maxlength' => true,'id'=>'Services_Tag']) ?>
        </div>
        <div class="col-2">
        <?= $form->field($model, 'Vesion_Product')->textInput(['maxlength' => true,'id'=>'Vesion_Product']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
        <?= $form->field($model, 'Status_Aset')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
        <?= $form->field($model, 'Project')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
        <?= $form->field($model, 'Location')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
        <?= $form->field($model, 'Date_Asset')->textInput(['class'=> 'form-control datetime1']) ?>
        </div>
    </div>



    <?= $form->field($model, 'Addon_Item')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>


<!-- ------------ MODAL ADD DIVISI------------------>
<div class="modal fade sasset" tabindex="-1" id="modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table table-bordered datatable" style="width:100%">
                  <thead>
                     <tr>
                        <th>
                           UserName
                        </th>
                        <th>
                           Host name
                        </th>
                        <th>
                           Action
                        </th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD DIVISI ------------------>