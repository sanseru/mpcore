<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelReferralNonMemberLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referral Non Member';
// $this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$('#control_sidebar').addClass('sidebar-collapse');
");
$this->registerJs("
$('body').on('click', '#openmodas', function (e) {
let id = $(this).data('id');
let code = 1;
  $.post('/api/get-file-ref',{
    id: id,
  },
  function(data){
    console.log(data)
    if(data.status == 'Success'){
      $('#link').html(data.documentfile);
      $('#solink').html(data.gl_file);

    }
  });
});

$('body').on('click', '#pdfobject', function (e) {
  let b64 = $(this).data('id');
  let jenis = $(this).data('jenis');
  if(b64.indexOf('pdf') != -1){
    if(jenis == 'docref'){
    let link = '".Yii::getAlias('@web/upload/referral/billing/')."';
    PDFObject.embed(link+b64, \"#my-pdf\");
    }else{
      let link = '".Yii::getAlias('@web/upload/referral/so/'). "';
      PDFObject.embed(link+b64, \"#my-pdf\");
    }
  }else{
    alert('Bukan PDF')
  }
  });

  $('body').on('click', '#deletefiles', function (e) {
    let value = $(this).data('value');
    let id = $(this).data('id');
      $.post('/api/delete-file-reff',{
        name: value,
        id: id,
      },
      function(data){
        console.log(data)
        if(data.data == 'success'){
          Swal.fire(
            'Good job!',
            'Delete File Berhasil',
            'success'
          )
          // $('#link').remove();
          // $('#solink').html();
          $.post('/api/get-file-ref',{
            id: id,
          },
          function(data){
            if(data.status == 'Success'){
              $('#link').html(data.documentfile);
              $('#solink').html(data.gl_file);
            }
          });
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })
        }
      });
    });

    $('body').on('click', '#deletegl', function (e) {
      let value = $(this).data('value');
      let id = $(this).data('id');
        $.post('/api/delete-filegl-reff',{
          name: value,
          id: id,
        },
        function(data){
          console.log(data)
          if(data.data == 'success'){
            Swal.fire(
              'Good job!',
              'Delete File Berhasil',
              'success'
            )
            // $('#link').remove();
            // $('#solink').html();
            $.post('/api/get-file-ref',{
              id: id,
            },
            function(data){
              if(data.status == 'Success'){
                $('#link').html(data.documentfile);
                $('#solink').html(data.gl_file);
              }
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
            })
          }
        });
      });
");
?>
<div class="card card-body model-referral-non-member-log-index">

    <center><h5><?= Html::encode($this->title) ?> AR Pending</h5></center>
    <p>
    <?= Html::a('Back', ['index'], ['class' => 'btn btn-secondary btn-sm']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'table-responsive',
            'style' => 'font-size:10px;',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:10%'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['style' => 'min-width:65px'];
          },
            ],
            

            // 'id',
            [
                'attribute' => 'tanggal_terima_berkas',
                'headerOptions' => ['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'tanggal_periksa',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'nama_rs',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'no_invoice',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'no_gl',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'nama_peserta',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'jalur_pembuatan',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'jumlah',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'client',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'link_dokumen_invoice',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'document_file',
                'format' => 'raw',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
                'value'=> function ($model) {
                    $openviewe = "";
                    if (!empty($model->document_file)) {
                      $openviewe = "<button type=\"button\" class=\"btn btn-xs btn-outline-primary\" id='openmodas' data-id=\"$model->id\" data-toggle=\"modal\" data-target=\"#modaldocumentfile\"><i class='fas fa-eye'></i> Show</button>";
                    }
                    return $openviewe;
                },
            ],
            [
                'attribute'=>'tanggal_input_link_document',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'tanggal_kirim_dokument_ar_ap',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'remarks_tim_billing',
                'headerOptions'=>['style' => 'background-color:#C9DAF8'],
            ],
            [
                'attribute'=>'link_gl',
                'headerOptions'=>['style' => 'background-color:#D5A6BD'],
            ],
            [
                'attribute'=>'gl_file',
                'format' => 'raw',
                'headerOptions'=>['style' => 'background-color:#D5A6BD'],
                'value'=> function ($model) {
                    $openviewe = "";
                    if (!empty($model->gl_file)) {
                      $openviewe = "<button type=\"button\" class=\"btn btn-xs btn-outline-primary\" id='openmodas' data-id=\"$model->id\" data-toggle=\"modal\" data-target=\"#modalsofile\"><i class='fas fa-eye'></i> Show</button>";
                    }
                    return $openviewe;
                },
            ],
            [
                'attribute'=>'nomer_so',
                'headerOptions'=>['style' => 'background-color:#D5A6BD'],
            ],
            [
                'attribute'=>'nomer_pr',
                'headerOptions'=>['style' => 'background-color:#D5A6BD'],
            ],
            [
                'attribute'=>'tanggal_so_pr',
                'headerOptions'=>['style' => 'background-color:#D5A6BD'],
            ],
            [
                'attribute'=>'nomer_ar',
                'headerOptions'=>['style' => 'background-color:#FFE599'],
            ],
            [
                'attribute'=>'remarks_tim_ar',
                'headerOptions'=>['style' => 'background-color:#FFE599'],
            ],
            [
                'attribute'=>'nomer_po',
                'headerOptions'=>['style' => 'background-color:#FF9900'],
            ],
            [
                'attribute'=>'remarks_tim_procurement',
                'headerOptions'=>['style' => 'background-color:#FF9900'],
            ],
            [
                'attribute'=>'nomer_ap',
                'headerOptions'=>['style' => 'background-color:#B6D7A8'],
            ],
            [
                'attribute'=>'remark_tim_ap',
                'headerOptions'=>['style' => 'background-color:#B6D7A8'],    
            ],

            //'created_at',
            //'created_by',
            //'update_at',
            //'Update_by',
            //'status_permasalahan',
            //'created_at_so',
            //'created_by_so',
            //'update_at_so',
            //'update_by_so',
            //'created_at_ar',
            //'created_by_ar',
            //'update_at_ar',
            //'update_by_ar',
            //'created_at_po',
            //'created_by_po',
            //'update_at_po',
            //'update_by_po',
            //'created_at_ap',
            //'created_by_ap',
            //'update_at_ap',
            //'update_by_ap',

            ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:30%'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['style' => 'min-width:143px'];
          },
            'template' => '{so}{ar}{po}{ap}',
            'buttons' => [
                'so' => function ($url, $model) {
                    return Html::a('&nbsp<span class="fas fa-barcode fa-2x">&nbsp</span>', ['/referral-non-member/so','id'=>$model->id,'code'=>$model->id], ['title' => Yii::t('app', 'Add SO')]);
                },
                'ar' => function ($url, $model) {
                    return Html::a('&nbsp<span class="fas fa-file-alt fa-2x">&nbsp</span>', ['/referral-non-member/ar','id'=>$model->id,'code'=>$model->id], ['title' => Yii::t('app', 'Add AR')]);
                },
                'po' => function ($url, $model) {
                    return Html::a('&nbsp<span class="fas fa-shopping-cart fa-2x">&nbsp</span>', ['/referral-non-member/po','id'=>$model->id,'code'=>$model->id], ['title' => Yii::t('app', 'Add PO')]);
                },
                'ap' => function ($url, $model) {
                    return Html::a('&nbsp<span class="fas fa-shopping-basket fa-2x">&nbsp</span>', ['/referral-non-member/ap','id'=>$model->id,'code'=>$model->id], ['title' => Yii::t('app', 'Add AP')]);
                },
            ]
            ],

        ],
    ]); ?>


</div>

<style>
  .pdfobject-container {
    max-width: 100%;
    width: 900px;
    height: 600px;
    border: 10px solid rgba(0, 0, 0, .2);
    margin: 0;
  }
</style>

<div class="modal fade" id="modaldocumentfile">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Document File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="link"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modalsofile">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">GL File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="solink"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">PDF Viewer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="my-pdf"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->