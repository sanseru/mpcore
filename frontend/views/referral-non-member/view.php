<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelReferralNonMemberLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Referral Non Member Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="model-referral-non-member-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal_terima_berkas',
            'tanggal_periksa',
            'nama_rs',
            'no_invoice',
            'no_gl',
            'nama_peserta',
            'jalur_pembuatan',
            'jumlah',
            'client',
            'link_dokumen_invoice:ntext',
            [
                'attribute' => 'document_file',
                'format' => 'raw',
                'headerOptions' => ['style' => 'background-color:#C9DAF8'],
                'value' => function ($model) {
                  $openviewe = "";
                  $option="";
                  if (!empty($model->document_file)) {

                     $array = explode(";",$model->document_file);
                     foreach ($array as $key => $value) {
                        if(!empty($value)){
                            $option .=
                            Html::a($value, ['referral-non-member/download-reff-document','name' => $value,], ['class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',])."</br>";
                        }
                    }
                  }
                  return $option;
                },
              ],
            'tanggal_input_link_document',
            'tanggal_kirim_dokument_ar_ap',
            'remarks_tim_billing:ntext',
            'link_gl:ntext',
            'nomer_so',
            'nomer_pr',
            'tanggal_so_pr',
            'nomer_ar',
            'remarks_tim_ar:ntext',
            'nomer_po',
            'remarks_tim_procurement:ntext',
            'nomer_ap',
            'remark_tim_ap:ntext',
            'created_at',
            'created_by',
            'update_at',
            'Update_by',
            'status_permasalahan',
            'created_at_so',
            'created_by_so',
            'update_at_so',
            'update_by_so',
            'created_at_ar',
            'created_by_ar',
            'update_at_ar',
            'update_by_ar',
            'created_at_po',
            'created_by_po',
            'update_at_po',
            'update_by_po',
            'created_at_ap',
            'created_by_ap',
            'update_at_ap',
            'update_by_ap',
        ],
    ]) ?>

</div>
