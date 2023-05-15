<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\ModelReferralTransmission;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelReferralNonMemberLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referral Non Member';
// $this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$('#control_sidebar').addClass('sidebar-collapse');
$('[data-toggle=\"tooltip\"]').tooltip();

");

$this->registerJs("
$(document).ready(function () {
    $(document).Toasts('create', {
        body: 'Untuk Melihat sisi kanan Table bisa pencet SHIFT lalu scroll mouse',
        class: 'bg-success', 
        title: 'Perhatian',
        subtitle: 'Employee',
        icon: 'fas fa-envelope fa-lg',
      });

    $.ajax({
        url: '/api/datareferal/',
        type: 'GET',
        success: function (data) {
            if(data.status == 'Success'){
            $('.soprdata').html(data.sopr);
            $('.ardata').html(data.ar);
            $('.podata').html(data.po);
            $('.apdata').html(data.ap);
            $('.gldata').html(data.gl);
            $('.transmissionx').html(data.transmission);

            
            }
        }
    });
});

$('body').on('click', '#openmodas', function (e) {
let id = $(this).data('id');
let code = 1;
  $.post('/api/get-file-ref',{
    id: id,
  },
  function(data){
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

  <center>
    <h5><?= Html::encode($this->title) ?></h5>
  </center>
  <div class="row">
  <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box">
        <span class="info-box-icon bg-maroon elevation-1">
          <?= Html::a('<i class="fas fa-file-invoice"></i>', ['documentpending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">Document Pending</span>
          <span class="info-box-number gldata">
            <small></small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1">
          <?= Html::a('<i class="fas fa-file-invoice"></i>', ['soprpending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">SO & PR Pending</span>
          <span class="info-box-number soprdata">
            <small>%</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box">
        <span class="info-box-icon bg-blue elevation-1">
          <?= Html::a('<i class="fas fa-archive"></i>', ['arappending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">AR & AP Pending</span>
          <span class="info-box-number soprdata">
            <small>%</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1">
          <?= Html::a('<i class="fas fa-file-invoice-dollar"></i>', ['arpending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">AR Pending</span>
          <span class="info-box-number ardata"></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1">
          <?= Html::a('<i class="fas fa-shopping-cart"></i>', ['popending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">PO Pending</span>
          <span class="info-box-number podata"></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1">
          <?= Html::a('<i class="fas fa-comments-dollar"></i>', ['appending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">AP Pending</span>
          <span class="info-box-number apdata"></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-fuchsia elevation-1">
          <?= Html::a('<i class="fas fa-comments"></i>', ['transmissionpending'], ['class' => '']) ?></span>
        <div class="info-box-content">
          <span class="info-box-text">Transmission Pending</span>
          <span class="info-box-number transmissionx"></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <p>
    <?= Html::a('Create Referral Non Member', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
    <?= Html::a('Exportdata', ['report'], ['class' => 'btn btn-warning btn-sm float-right']) ?>
    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
      Chat
    </button>

  </p>

  <?php // echo $this->render('_search', ['model' => $searchModel]); 
  ?>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
      'class' => 'table-responsive',
      'style' => 'font-size:10px;',
    ],
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      [
        'label' => 'Transmission',
        'attribute' => 'id',
        'format' => 'raw',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
        'value' => function ($model) {
          //     $button ="<a href=refnontransmission/\"$model->id\"><span class='fa-stack fa-2x has-badge' data-count='    '>
          //     <i class='fas fa-comments fa-stack-1x'></i>
          //   </span></a>";
          $badge = '';
          $count = ModelReferralTransmission::find()
            ->where(['status' => 0])
            ->Andwhere(['idreferral' => $model->id])
            ->count();
          if ($count > 0) {
            $badge = "data-count=$count";
          }
          return Html::a('<span class="fa-stack fa-2x has-badge" ' . $badge . '>
                      <i class="fas fa-comments fa-stack-1x"></i>
                    </span>', ['/referral-non-member/transmission', 'id' => $model->id, 'code' => $model->id], ['title' => Yii::t('app', 'Add PO')]);

          // return $button;
        },
      ],
      [
        'class' => 'yii\grid\ActionColumn',
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
        'attribute' => 'tanggal_periksa',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'nama_rs',
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:200px'];
        },
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'no_invoice',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
        'format' => 'raw',
        'value' => function ($model) {
          $openviewe = "";
          $split2="";
          $split1 = explode(";",$model->invoicehistory);
          foreach ($split1 as $key => $value) {
            if($value != ""){
              $split2 .= "No Invoice : ".$value ."</br>";
          }          
        }
          if (!empty($model->invoicehistory)) {
            $openviewe = "<i class='fas fa-hourglass ml-2' data-toggle='tooltip' data-html='true' title='$split2'></i>";
          }
          return $model->no_invoice.$openviewe;
        },
      ],
      [
        'attribute' => 'no_gl',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'covteq',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'nama_peserta',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'jalur_pembuatan',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'jumlah',
        'format' => 'Currency',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'client',
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:200px'];
        },
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'link_dokumen_invoice',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'document_file',
        'format' => 'raw',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
        'value' => function ($model) {
          $openviewe = "";
          if (!empty($model->document_file)) {
            $openviewe = "<button type=\"button\" class=\"btn btn-xs btn-outline-primary\" id='openmodas' data-id=\"$model->id\" data-toggle=\"modal\" data-target=\"#modaldocumentfile\"><i class='fas fa-eye'></i> Show</button>";
          }
          return $openviewe;
        },
      ],
      [
        'attribute' => 'tanggal_input_link_document',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'tanggal_kirim_dokument_ar_ap',
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'remarks_tim_billing',
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:200px'];
        },
        'headerOptions' => ['style' => 'background-color:#C9DAF8'],
      ],
      [
        'attribute' => 'link_gl',
        'headerOptions' => ['style' => 'background-color:#D5A6BD'],
      ],
      [
        'attribute' => 'gl_file',
        'format' => 'raw',
        'headerOptions' => ['style' => 'background-color:#D5A6BD'],
        'value' => function ($model) {
          $openviewe = "";
          if (!empty($model->gl_file)) {
            $openviewe = "<button type=\"button\" class=\"btn btn-xs btn-outline-primary\" id='openmodas' data-id=\"$model->id\" data-toggle=\"modal\" data-target=\"#modalsofile\"><i class='fas fa-eye'></i> Show</button>";
          }
          return $openviewe;
        },
      ],
      [
        'attribute' => 'nomer_so',
        'headerOptions' => ['style' => 'background-color:#D5A6BD'],
        'format' => 'raw',
        'value' => function ($model) {
          $openviewe = "";
          $split2="";
          $split1 = explode(";",$model->sohistory);
          foreach ($split1 as $key => $value) {
            if($value != ""){
              $split2 .= "No so : ".$value ."</br>";
          }          
        }
          if (!empty($model->sohistory)) {
            $openviewe = "<i class='fas fa-hourglass ml-2' data-toggle='tooltip' data-html='true' title='$split2'></i>";
          }
          return $model->nomer_so.$openviewe;
        },
      ],
      [
        'attribute' => 'nomer_pr',
        'headerOptions' => ['style' => 'background-color:#D5A6BD'],
      ],
      [
        'attribute' => 'tanggal_so_pr',
        'headerOptions' => ['style' => 'background-color:#D5A6BD'],
      ],
      [
        'attribute' => 'nomer_ar',
        'headerOptions' => ['style' => 'background-color:#FFE599'],
      ],
      [
        'attribute' => 'remarks_tim_ar',
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:200px'];
        },
        'headerOptions' => ['style' => 'background-color:#FFE599'],
      ],
      [
        'attribute' => 'nomer_po',
        'headerOptions' => ['style' => 'background-color:#FF9900'],
      ],
      [
        'attribute' => 'remarks_tim_procurement',
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:200px'];
        },
        'headerOptions' => ['style' => 'background-color:#FF9900'],
      ],
      [
        'attribute' => 'nomer_ap',
        'headerOptions' => ['style' => 'background-color:#B6D7A8'],
      ],
      [
        'attribute' => 'remark_tim_ap',
        'headerOptions' => ['style' => 'background-color:#B6D7A8'],
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

      [
        'class' => 'yii\grid\ActionColumn',
        'headerOptions' => ['style' => 'width:30%'],
        'contentOptions' => function ($model, $key, $index, $column) {
          return ['style' => 'min-width:143px'];
        },
        'template' => '{so}{ar}{po}{ap}',
        'buttons' => [
          'so' => function ($url, $model) {
            return Html::a('&nbsp<span class="fas fa-barcode fa-2x">&nbsp</span>', ['/referral-non-member/so', 'id' => $model->id, 'code' => $model->id], ['title' => Yii::t('app', 'Add SO')]);
          },
          'ar' => function ($url, $model) {
            return Html::a('&nbsp<span class="fas fa-file-alt fa-2x">&nbsp</span>', ['/referral-non-member/ar', 'id' => $model->id, 'code' => $model->id], ['title' => Yii::t('app', 'Add AR')]);
          },
          'po' => function ($url, $model) {
            return Html::a('&nbsp<span class="fas fa-shopping-cart fa-2x">&nbsp</span>', ['/referral-non-member/po', 'id' => $model->id, 'code' => $model->id], ['title' => Yii::t('app', 'Add PO')]);
          },
          'ap' => function ($url, $model) {
            return Html::a('&nbsp<span class="fas fa-shopping-basket fa-2x">&nbsp</span>', ['/referral-non-member/ap', 'id' => $model->id, 'code' => $model->id], ['title' => Yii::t('app', 'Add AP')]);
          },
        ]
      ],

    ],
  ]); ?>


</div>
<style>
  .fa-stack[data-count]:after {
    position: absolute;
    right: 0%;
    top: 1%;
    content: attr(data-count);
    font-size: 30%;
    padding: .6em;
    border-radius: 999px;
    line-height: .75em;
    color: white;
    background: rgba(255, 0, 0, .85);
    text-align: center;
    min-width: 2em;
    font-weight: bold;
  }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        include Yii::getAlias('@webroot') . '/inc/shoutbox/shoutbox.inc.php';
        ?>
      </div>
    </div>
  </div>
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