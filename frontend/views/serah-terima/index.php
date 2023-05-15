<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelSerahterimaassetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Model Serahterimaassets';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
$(document).ready(function () {
    bsCustomFileInput.init();
  });
  
$('#modals').click(function() {
    var id = $(this).attr('data-id');
    $('#idserahinput').val(id);
});

$('#upload').click(function() {
    var property = document.getElementById('idserah').files[0];
    var idnyaax = document.getElementById('idserahinput').value;
    var form_data = new FormData();
    form_data.append(\"file\", property);
    form_data.append(\"inputan\", idnyaax);
    $.ajax({
        url:'api/uploadserah',
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            Swal.fire(
                'Good job!',
                'Lu Gan Emang Reseeee!',
                'success'
              )
              $('.uploadfile').modal('hide');

        }
      });
});


");

$this->registerCss("
    .pencet{
        cursor:pointer;
    }
");
?>
<div class="card">
<div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Form Asset', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'User_Name',
            'Host_Name',
            // 'Manufacturer',
            // 'Services_Tag',
            // 'Vesion_Product',
            'Status_Aset',
            'Project',
            'Location',
            //'Addon_Item:ntext',
            //'Date_Asset',
            //'Created_Time',
            //'Created_By',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{view}{print}{download}{upload}{delete}',
            'buttons' => [
                'print' => function ($url, $model) {
                    $url = Url::to(['serah-terima/print', 'id' => $model->id]);
                    return Html::a('&nbsp&nbsp<span class="fas fa-print">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Print'),'target'=>'_blank']);
                },
                'upload' => function ($url, $model) {
                    return Html::a('<span class="fas fa-upload">&nbsp&nbsp</span>', '', ['title' => Yii::t('app', 'Upload'),'id'=>'modals','data-toggle'=>'modal', 'data-target'=>'.uploadfile', 'data-id'=>$model->id]);
                },
                'download' => function ($url, $model) {
                    if(!empty($model->namaFile)){
                        $url = Url::to(['serah-terima/downloadfile', 'filename' => $model->namaFile]);
                        $tombol = Html::a('<span class="fas fa-download">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Download')]);
                    }else{
                        $tombol = '';
                    }
                    return $tombol;
                },

            ],
        ],
        ],
    ]); ?>


</div>
</div>

<div class="modal fade uploadfile" id="modal-sm">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Small Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="idserah" name="idserah">
                        <label class="custom-file-label" for="idserah">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text pencet" id="upload">Upload</span>
                      </div>
                    </div>
                  </div>
                <input type="hidden" id="idserahinput" name="idserahinput" />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->