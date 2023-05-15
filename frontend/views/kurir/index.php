<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$this->registerJs("
$('.js-data-example-ajax').select2({
    tags: true,
    ajax: {
        // url: 'https://api.github.com/search/repositories',
        url: '../api/get-bisnis-select',
        dataType: 'json',
        type: 'GET',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
                var res = data.items.map(function (item) {
                    return {id: item.CardName, text: item.CardName};
                });
            return {
                results: res
            };
        }
    },
});

$(document).on(\"change\", \".js-data-example-ajax\", function () {		
    var penerimax = $('#penerima').val();
    $.post('/api/get-bisnis',{
        name: penerimax
    },
    function(data){
        // console.log(data)
        $('#alamat').val(data.Address);
        $('#nopenerima').val(data.Phone1);
    });
})

$('#formExcel').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url:'/kurir/uploadexcell',
      method:'POST',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      success:function(data){
          console.log(data);
          $('#formExcel')[0].reset();
        tableApiServerSide('.pengiriman','api/pengiriman');
        $('#modal-upload').modal('hide');
        Swal.fire(
            'Upload Berhasil!',
            'Saved',
            'success'
          )
          var link = 'https://mpcore.medikaplaza.com/kurir/downloadupload?data='+data.filenya
          window.open(link, '_blank');

      }
    })
})

$('#kirim').submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: 'POST',
           url: '/api/post-kirim',
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            serverside()
            $('#kirim')[0].reset();
            $('#penerima').val(null).trigger('change');
            Swal.fire(
                'Good job!',
                'Saved',
                'success'
              )
           }
         });

    
});
");

$this->registerJs("
    $('#control_sidebar').addClass('sidebar-collapse');
    $( document ).ready(function() {
        serverside()
    });
    function serverside() {
        tableApiServerSide('.pengiriman','api/pengiriman');

     }
");

$this->registerJs("
function gettracking(id)
{
    for (let i = 1; i <= 4; i++) {
        console.log(i)
        let idx = '#'+i+'progress'
        $(idx).removeClass( \"active\" );
    }
    $.post('/api/get-kurir',{
        id: id
    },
    function(data){
        // console.log(data)
        $('#progressbar').show();
        $('#cancelimage').hide();

        $('.codekirim').html('#'+data.codekirim.toUpperCase());
        $('.kemana').html('#'+data.penerima.toUpperCase());

        for (let i = 1; i <= data.status; i++) {
            console.log(i)
            let idx = '#'+i+'progress'
            $(idx).addClass( \"active\" );
        }
        if(data.status == 5 ){
            $('#progressbar').hide();
            $('#cancelimage').show();

        }
        gethisttracking(id)

    });
}

function residiterimakembali(id) {
Swal.fire({
  title: 'Are you sure?',
  text: \"You won't be able to revert this!\",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
    if (result.value) {
    $.post('/api/resikembali',{
        id: id
    },
    function(data){
        Swal.fire(
            'Saved!',
            'Your data has been save.',
            'success'
          )
    });
}
  })
}

function deletedata(id) {
    Swal.fire({
      title: 'Are you sure Delete This Data?',
      text: \"You won't be able to revert this!\",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!, Delete it'
    }).then((result) => {
        if (result.value) {
            $.post('/kurir/delete',{
                id: id
            },
            function(data){
                tableApiServerSide('.pengiriman','api/pengiriman');
                Swal.fire(
                    'Saved!',
                    'Your file has been deleted.',
                    'success'
                  )
            });          
        }

    
      })
    }

function gethisttracking(id)
{
    $.post('/api/get-hist-kurir',{
        id: id
    },
        function(data){
            console.log(data)
            $('#timeline').html(data);
        }
    );
}
", View::POS_END);
?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Permintaan Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="kirim">
                <div class="card-body">
                    <p class="text-center">
                        <i class="fas fa-truck fa-2x"></i>
                    </p>
                    <h5>Data Penerima</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerima"><i class="fas fa-user"></i> Penerima</label>
                                <select class="form-control form-control-sm js-data-example-ajax" id="penerima" name="penerima"></select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerima"><i class="fas fa-user"></i> Nama PIC</label>
                                <input type="text" class="form-control form-control-sm" id="pic" name="pic">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nopenerima"><i class="fas fa-phone"></i> No Penerima</label>
                                <input type="text" class="form-control form-control-sm" id="nopenerima" name="nopenerima">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namabarang"><i class="fas fa-box"></i> Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang" name="namabarang" autocomplete="on">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamatpenerima"><i class="fa fa-location-arrow" aria-hidden="true"></i> Alamat Penerima</label>
                        <textarea type="text" class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Masukan Alamat Yang Lengkap Agara Mudah Dalam melakukan Pengiriman"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamatpenerima"><i class="fa fa-pen" aria-hidden="true"></i> Catatan</label>
                        <textarea type="text" class="form-control form-control-sm" id="catatan" name="catatan" placeholder="Masukan No Invoice / Medical Record / Yang lainnya"></textarea>
                    </div>
                    <h5>Data Pengirim</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengirim">Pengirim</label>
                                <input type="text" class="form-control form-control-sm" id="pengirim" name="pengirim" value="<?= (Yii::$app->user->identity->full_name == NULL || Yii::$app->user->identity->full_name == "" ? Yii::$app->user->identity->username : Yii::$app->user->identity->full_name); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengirim">No Telepon</label>
                                <input type="text" class="form-control form-control-sm" id="nopengirim" name="nopengirim" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" id="upload" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-upload"><i class="fas fa-file-excel"></i> Upload</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered pengiriman table-striped" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th>No Pengiriman</th>
                            <th>Penerima</th>
                            <th>Nama Barang</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<style>
    .cardsx {
        z-index: 0;
        background-color: #eceff1;
        padding-bottom: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .top {
        padding-top: 40px;
        padding-left: 13% !important;
        padding-right: 13% !important;
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455a64;
        padding-left: 0px;
        margin-top: 30px;
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
    }

    #progressbar .step0:before {
        font-family: "Font Awesome 5 Free";
        content: "\f111";
        color: #fff;
        transition: all 0.2s;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #c5cae9;
        border-radius: 50%;
        margin: auto;
        padding: 0px;
    }

    #progressbar li:after {
        content: "";
        width: 100%;
        height: 12px;
        background: #c5cae9;
        position: absolute;
        left: 0;
        top: 16px;
        z-index: -1;
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%;
    }

    #progressbar li:nth-child(2):after,
    #progressbar li:nth-child(3):after {
        left: -50%;
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%;
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #651fff;
    }

    #progressbar li.active:before {
        font-family: "Font Awesome 5 Free";
        content: "\f058";
    }

    .icon {
        width: 60px;
        height: 60px;
        margin-right: 15px;
    }

    .icon-content {
        padding-bottom: 20px;
    }

    @media screen and (max-width: 992px) {
        .icon-content {
            width: 50%;
        }
    }

    img {
        transition: transform 0.25s ease;
    }

    img:hover {
        -webkit-transform: scale(1.5);
        transform: scale(1.5);
    }

    .responsiveimg {
        width: 100%;
        height: auto;
    }
</style>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Tracking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card cardsx">
                    <div class="row d-flex justify-content-between px-3 top">
                        <div class="d-flex">
                            <h5>ORDER <span class="text-primary font-weight-bold codekirim">#Y34XDHR</span></h5>
                        </div>
                        <div class="d-flex flex-column text-sm-right">
                            <!-- <p class="mb-0">Expected Arrival <span>01/12/19</span></p> -->
                            <p>To: <span class="font-weight-bold kemana ">234094567242423422898</span></p>
                        </div>
                    </div> <!-- Add class 'active' to progress -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <?= Html::img('@web/images/cancel.png', ['id' => 'cancelimage', 'alt' => 'some', 'class' => 'responsiveimg thing', 'style' => 'display: none;']); ?>

                            <ul id="progressbar" class="text-center">
                                <li id="1progress" class="step0">Order<br>Manifested</li>
                                <li id="2progress" class="step0">Order<br>On Process</li>
                                <li id="3progress" class="step0">Order<br>On Delivery</li>
                                <li id="4progress" class="step0">Order<br>Delivered</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
                    <ul id="timeline">
                        <li><span></span>
                            <div>
                                <div class="title">Codify</div>
                                <div class="info">Let&apos;s make coolest things in css</div>
                                <div class="type">Presentation</div>
                            </div><span class="number"><span>10:00</span><span>12:00</span></span>
                        </li>
                        <li>
                            <div><span></span>
                                <div class="title">Codify</div>
                                <div class="info">Let&apos;s make coolest things in javascript</div>
                                <div class="type">Presentation</div>
                            </div><span class="number"><span>13:00</span><span>14:00</span></span>
                        </li>
                        <li>
                            <div><span></span>
                                <div class="title">Codify</div>
                                <div class="info">Let&apos;s make coolest things in css <img class="icon" src="https://i.imgur.com/9nnc9Et.png"></div>
                                <div class="type">Review</div>
                            </div><span class="number"><span>15:00</span><span>17:45</span></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");


    .container ul {
        margin: 0;
        margin-top: 10px;
        margin-bottom: 20px;
        list-style: none;
        position: relative;
        padding: 1px 100px;
        color: #000000;
        font-size: 13px;
    }

    .container ul:before {
        content: "";
        width: 1px;
        height: 100%;
        position: absolute;
        border-left: 2px dashed #558de0;
    }

    .container ul li {
        position: relative;
        margin-left: 30px;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 14px;
        border-radius: 6px;
        width: 250px;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.12), 0 2px 2px rgba(0, 0, 0, 0.08);
    }

    .container ul li:not(:first-child) {
        margin-top: 60px;
    }

    .container ul li>span {
        width: 2px;
        height: 100%;
        background: #558de0;
        left: -30px;
        top: 0;
        position: absolute;
    }

    .container ul li>span:before,
    .container ul li>span:after {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        border: 2px solid #558de0;
        position: absolute;
        background: #86b7e7;
        left: -5px;
        top: 0;
    }

    .container ul li span:after {
        top: 100%;
    }

    .container ul li>div {
        margin-left: 10px;
    }

    .container div .title,
    .container div .type {
        font-weight: 600;
        font-size: 12px;
    }

    .container div .info {
        font-weight: 300;
    }

    .container div>div {
        margin-top: 5px;
    }

    .container span.number {
        height: 100%;
    }

    .container span.number span {
        position: absolute;
        font-size: 10px;
        left: -60px;
        font-weight: bold;

    }

    .container span.number span:first-child {
        top: 0;
    }

    .container span.number span:last-child {
        top: 100%;
    }
</style>



<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formExcel" enctype="multipart/form-data">
                    <label>File Excel</label>
                    <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                    <div class="form-group">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::a('<i class="fas fa-download"></i> Template ', ['downloadimport'], ['class' => 'btn btn-success']) ?>
                <button class="btn btn-primary float-right" type="submit">Upload</button>

            </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->