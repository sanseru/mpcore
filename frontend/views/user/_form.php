<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use frontend\models\ModelRole;
use frontend\models\ModelOfficeLocation;
use frontend\models\ModelDepartment;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
<div class="card card-header">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'role', ['options' => ['tag' => 'false']])-> dropDownList(
            ArrayHelper::map(ModelRole::find()->where(['flag'=>1])->all(),'idrole','role_name'),
            ['prompt'=>'- Select -','class'=>'form-control']);  ?>
    <?= $form->field($model, 'office', ['options' => ['tag' => 'false']])-> dropDownList(
            ArrayHelper::map(ModelOfficeLocation::find()->all(),'id','office'),
            ['prompt'=>'- Select -','class'=>'form-control']);  ?>
    <?= $form->field($model, 'department', ['options' => ['tag' => 'false']])-> dropDownList(
            ArrayHelper::map(ModelDepartment::find()->all(),'id','department'),
            ['prompt'=>'- Select -','class'=>'form-control']);  ?>

    </br><div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
