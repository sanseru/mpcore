<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmenu') ?>

    <?= $form->field($model, 'nama_menu') ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'flag') ?>

    <?= $form->field($model, 'icon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
