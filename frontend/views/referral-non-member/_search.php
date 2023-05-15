<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralNonMemberLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-referral-non-member-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal_terima_berkas') ?>

    <?= $form->field($model, 'tanggal_periksa') ?>

    <?= $form->field($model, 'nama_rs') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?php // echo $form->field($model, 'no_gl') ?>

    <?php // echo $form->field($model, 'nama_peserta') ?>

    <?php // echo $form->field($model, 'jalur_pembuatan') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'link_dokumen_invoice') ?>

    <?php // echo $form->field($model, 'document_file') ?>

    <?php // echo $form->field($model, 'tanggal_input_link_document') ?>

    <?php // echo $form->field($model, 'tanggal_kirim_dokument_ar_ap') ?>

    <?php // echo $form->field($model, 'remarks_tim_billing') ?>

    <?php // echo $form->field($model, 'link_gl') ?>

    <?php // echo $form->field($model, 'nomer_so') ?>

    <?php // echo $form->field($model, 'nomer_pr') ?>

    <?php // echo $form->field($model, 'tanggal_so_pr') ?>

    <?php // echo $form->field($model, 'nomer_ar') ?>

    <?php // echo $form->field($model, 'remarks_tim_ar') ?>

    <?php // echo $form->field($model, 'nomer_po') ?>

    <?php // echo $form->field($model, 'remarks_tim_procurement') ?>

    <?php // echo $form->field($model, 'nomer_ap') ?>

    <?php // echo $form->field($model, 'remark_tim_ap') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'Update_by') ?>

    <?php // echo $form->field($model, 'status_permasalahan') ?>

    <?php // echo $form->field($model, 'created_at_so') ?>

    <?php // echo $form->field($model, 'created_by_so') ?>

    <?php // echo $form->field($model, 'update_at_so') ?>

    <?php // echo $form->field($model, 'update_by_so') ?>

    <?php // echo $form->field($model, 'created_at_ar') ?>

    <?php // echo $form->field($model, 'created_by_ar') ?>

    <?php // echo $form->field($model, 'update_at_ar') ?>

    <?php // echo $form->field($model, 'update_by_ar') ?>

    <?php // echo $form->field($model, 'created_at_po') ?>

    <?php // echo $form->field($model, 'created_by_po') ?>

    <?php // echo $form->field($model, 'update_at_po') ?>

    <?php // echo $form->field($model, 'update_by_po') ?>

    <?php // echo $form->field($model, 'created_at_ap') ?>

    <?php // echo $form->field($model, 'created_by_ap') ?>

    <?php // echo $form->field($model, 'update_at_ap') ?>

    <?php // echo $form->field($model, 'update_by_ap') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
