<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\ArrayHelper;




$this->registerJs("
    $(document).ready(function() {

    });
    $('#reservation').daterangepicker({
        \"singleDatePicker\": true,
            'locale': {
                    'format': 'DD-MM-YYYY',
                }, 
        })
    $('#reservation2').daterangepicker({
        \"singleDatePicker\": true,
            'locale': {
                    'format': 'DD-MM-YYYY',
                }, 
        })
");

?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Date picker</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation" name="tgl1">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation2" name="tgl2">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::a(' Export', ['report'], ['class' => 'btn btn-info fa  fa-file-excel-o','data-method' => 'POST']) ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<?php ActiveForm::end(); ?>