<?php
use yii\helpers\Html;
use frontend\models\ModelReferralNonMemberLog;

function TableReff($id)
{
    $model = ModelReferralNonMemberLog::findOne($id);
    $download = "";
    $array = explode(";",$model->document_file);
    foreach ($array as $key => $value) {
        if(!empty($value)){
            $download .= Html::a('<i class="fas fa-share"></i>', ['referral-non-member/download-reff-document-new-tab','name' => $value,], ['title'=>'Open New Tab','class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',]);
        }
    }


    return  "
    <div class='row invoice-info'>
        <div class='col-sm-4 invoice-col'>
        <strong>Detail Data : $model->nama_peserta</strong>
            <address>
                No Invoice : $model->no_invoice<br>
                Nama RS : $model->nama_rs <br>
                Tanggal Periksa : $model->tanggal_periksa<br>
                Tanggal Terima Berkas : $model->tanggal_terima_berkas<br>
                Jalur Pembuatan: $model->jalur_pembuatan
            </address>
        </div>
        <!-- /.col -->
        <div class='col-sm-4 invoice-col'>
            <address>
                No GL : $model->no_gl<br>
                No SO : $model->nomer_so<br>
                No PR : $model->nomer_pr<br>
                No AR : $model->nomer_ar<br>
                No PO : $model->nomer_po<br>
                No AP : $model->nomer_ap<br>
            </address>
        </div>
        <!-- /.col -->
        <div class='col-sm-4 invoice-col'>
                Tanggal Input Link Document : $model->tanggal_input_link_document<br>
                Tanggal Kirim Dokument AR/AP : $model->nomer_so<br>
                Remarks BIlling: $model->sohistory<br>
                No So History : $model->nomer_ar<br>
                Document File : $download<br>
                </div>
        <!-- /.col -->
        </div>
        ";
}
?>
