<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use Hashids\Hashids;
use frontend\models\ModelWhgudang;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelWarehouseStockOPHead */
/* @var $form yii\widgets\ActiveForm */

$hashids = new Hashids('stockopnamex',8);

$this->registerJs("
    $(document).ready(function() {
        $('.tgl_mulai').daterangepicker({
            singleDatePicker: true,
            locale: {
              format: 'YYYY-MM-DD'
            }
          })
    });
    
");
?>

<div class="card">
<div class="card-header">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'idStockOP')->textInput(['maxlength' => true,'readonly'=> 'true','value' => $model->isNewRecord ? $hashids->encode(random_int(100, 100000))  : $model->idStockOP]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gudang')-> dropDownList(ArrayHelper::map(ModelWhgudang::find()->all(),'id','name'),['prompt'=>'- Select -','class'=>'form-control form-control-sm']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'tanggal_mulai')->textInput(['class'=>'form-control tgl_mulai']) ?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'penanggungJawab')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
        <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <?php if(Yii::$app->user->identity->role == 8 || Yii::$app->user->identity->role == 3){ ?>
    <?= ($model->isNewRecord) ? '' : $form->field($model, 'status')->dropDownList([1=>'Open',2=>'Closed'],
            ['prompt'=>'- Select -'])->label('Status');?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Process Opname', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
