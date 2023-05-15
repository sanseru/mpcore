<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMenu */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">
<div class="card card-header">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_menu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->dropDownList([1=>'Enable',2=>'Disable'],
            ['prompt'=>'- Select -'])->label('Status');?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>