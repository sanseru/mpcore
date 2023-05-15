<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Invoice Upload';

?>

<?php $form = ActiveForm::begin([
  'options' => [
    'enctype' => 'multipart/form-data',
  ]
]);
?>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Upload Data Alkes</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputFile">Pilih File</label>
      <div class="input-group">
        <?= $form->field($model, 'pic1')->fileInput(['class' => 'form control', 'id' => 'exampleInputFile'])->label(false) ?>
      </div>
    </div>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('<i class="fas fa-download"></i> Download Template ', ['download'], ['class' => 'btn btn-success']) ?>

  </div>
</div>
<?php ActiveForm::end(); ?>