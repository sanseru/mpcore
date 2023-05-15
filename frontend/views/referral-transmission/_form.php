<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\ModelUser;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralTransmission */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs("
$('.select2').select2({});
");
?>

<div class="card card-body model-referral-transmission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Open', '1' => 'Close'],['prompt'=>'Select Option']); ?>
    
    <?= $form->field($model, 'assign_to')-> dropDownList(ArrayHelper::map(ModelUser::find()->all(),'username','username'),['prompt'=>'- Select -','class'=>'form-control form-control-sm select2'])->label('Assign To') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
