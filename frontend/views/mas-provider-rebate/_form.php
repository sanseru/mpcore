<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMasProviderRebate */
/* @var $form yii\widgets\ActiveForm */


$this->registerCss("
    .search, .addprovider{
        cursor:pointer;
    }
");
$this->registerJs("
    function lookUpProvider(){
        tableApiServerSide('.providers','../api/get-provider');        
    }
    ",VIEW::POS_HEAD);
$this->registerJs("
$(document).on(\"click\", \".addprovider\", function () {		
        
    var data = $(this).data('id');
    data =  data.split(';');
    $('#idprovider').val(data[0]);
    $('#providername').val(data[1]);
    $('.provider-search').modal('hide')
})
");
?>

<div class="model-mas-provider-rebate-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'providerName', [
            'template' => '{label}<div class="input-group mb-12">{input}
            <div class="input-group-append">
            <span class="input-group-text search"><i class="fas fa-search" aria-hidden="true" data-toggle="modal" data-target=".provider-search" onClick="lookUpProvider();"></i></span>
            </div></div>{error}{hint}'
        ])->textInput(['maxlength' => true,'id'=>'providername','readonly'=>true]); ?>
        <input type="hidden" class="id" name="idprovider" id="idprovider">
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'rebate')->textInput(['placeholder'=>'Masukan Angka berapa Perseni. Contoh : 5% maka masukan 5, Jika 3.2% Maka Masukan 3.2']) ?>
        </div>
    </div>
    <?= $form->field($model, 'isdetail')->radioList( [1=>'Yes', 0 => 'No'], ['unselect' => 0] ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<!-- ------------ /MODAL ------------------>
<div class="modal fade provider-search" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Search Provider</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered providers"  id="provider" style="width:100%">
                        <thead>
                            <tr>
                                <th>Provider</th>
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