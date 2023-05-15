<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use frontend\models\ModelInvStatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelInvTrackHead */
/* @var $form yii\widgets\ActiveForm */


$this->registerCss("
    .search, .addinvoice{
        cursor:pointer;
    }
");

$this->registerJs("
    function lookUpInvoice(){
        tableApiServerSide('.invoices','../api/get-invoice');        
    }
    ",VIEW::POS_HEAD);


$this->registerJs("
$(document).on(\"click\", \".addinvoice\", function () {		
        
    var data = $(this).data('id');
    data =  data.split(';');
    $('#noinvoice').val(data[0]);
    $('#perusahaan').val(data[1]);

    $.post('api/invoice-preview',{
        invoice: data[0]
    },
    function(data, status){
        $('#preview').html(data);
    });

    $('.invoice-search').modal('hide')
})

$(document).on(\"change\", \".statusx\", function () {		
     alert();   

     var status = $('.statusx').val();

     if(status == 5){
     
    }else{


     }
     
    // var data = $(this).data('id');
    // data =  data.split(';');
    // $('#noinvoice').val(data[0]);
    // $('#perusahaan').val(data[1]);

    // $.post('api/invoice-preview',{
    //     invoice: data[0]
    // },
    // function(data, status){
    //     $('#preview').html(data);
    // });

    // $('.invoice-search').modal('hide')
})

");


?>


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'noinvoice', [
            'template' => '{label}<div class="input-group mb-12">{input}
            <div class="input-group-append">
            <span class="input-group-text search"><i class="fas fa-search" aria-hidden="true" data-toggle="modal" data-target=".invoice-search" onClick="lookUpInvoice();"></i></span>
            </div></div>{error}{hint}'
        ])->textInput(['maxlength' => true,'id'=>'noinvoice','readonly'=>true]); ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'perusahaan')->textInput(['maxlength' => true,'id'=>'perusahaan','readonly'=>true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">

        <?php
        if(!$model->isNewRecord){ ?>
            <?= $form->field($model, 'status', ['options' => ['tag' => 'false']])-> dropDownList(
                    ArrayHelper::map(ModelInvStatus::find()->all(),'id','status'),
                    ['prompt'=>'- Select -','class'=>'form-control select2 m-b-1 statusx','style' => 'width: 100%']); ?>
        <?php } ?>
        </div>
    </div>
    <div id="preview">
    
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>



<!-- ------------ /MODAL ------------------>
<div class="modal fade invoice-search" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Search Invoice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered invoices"  id="invoice" style="width:100%">
                        <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Perusahan</th>  	
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