<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModeWhAssetAlkes */

$this->title = $model->namaAlat;
$this->params['breadcrumbs'][] = ['label' => 'Asset Alkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss("
    .cls, .delete,.deletetracking,.deletecalibration{
        cursor:pointer;
    }
");

$this->registerJs("
    $(document).ready(function () {
        $( '.btn' ).remove();

        $('.datex').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            autoApply: 'true',
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
            }
        }, function (chosen_date) {
            $(this.element[0]).val(chosen_date.format('YYYY-MM-DD'));
        })
    });
    
");
$this->registerJs("
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

$(document).ready(function () {
    viewdata();
    viewdatatracking();
    viewdatacalibration();
    viewdatarepair(); 
    viewdataacessories(); 

});

$('#maint').on('submit', function (e) {
    $('#submaint').prop('disabled', true);
    var formData = new FormData(this);
    $.ajax({
        url: 'api/alkesmaintinsert',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data)
            $('#modal-maint').modal('toggle');
            $('#maint')[0].reset();
            viewdata();
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
        $('#submaint').prop('disabled', false);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        $('#submaint').prop('disabled', false);

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});


$('#tarckingsubmit').on('submit', function (e) {
    $('#subtracking').prop('disabled', true);
    var formData = new FormData(this);
    $.ajax({
        url: 'api/alkestrackinginsert',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data)
            $('#modal-tracking').modal('toggle');
            $('#tarckingsubmit')[0].reset();
            viewdatatracking();
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
        $('#subtracking').prop('disabled', false);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        $('#subtracking').prop('disabled', false);

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});



$('#calibrationsubmit').on('submit', function (e) {
    $('#subcalibration').prop('disabled', true);
    var formData = new FormData(this);
    $.ajax({
        url: 'api/alkescalibrationinsert',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data)
            $('#modal-calibration').modal('toggle');
            $('#calibrationsubmit')[0].reset();
            viewdatacalibration() ;
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
        $('#subcalibration').prop('disabled', false);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        $('#subcalibration').prop('disabled', false);

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});


$('#repairsubmit').on('submit', function (e) {
    $('#subrepair').prop('disabled', true);
    var formData = new FormData(this);
    $.ajax({
        url: 'api/alkesrepairinsert',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data)
            $('#modal-repair').modal('toggle');
            $('#repairsubmit')[0].reset();
            viewdatarepair() ;
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
        $('#subrepair').prop('disabled', false);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        $('#subrepair').prop('disabled', false);

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});


$('#acessoriessubmit').on('submit', function (e) {
    $('#subacessories').prop('disabled', true);
    var formData = new FormData(this);
    $.ajax({
        url: 'api/alkesacessoriesinsert',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data)
            $('#modal-acessories').modal('toggle');
            $('#acessoriessubmit')[0].reset();
            viewdataacessories() ;
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
        $('#subacessories').prop('disabled', false);

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        $('#subacessories').prop('disabled', false);

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});

$(document).on(\"click\", \".delete\", function () {	
    var key_ = $(this).data('id');
        if (confirm('Are you sure you want to delete this?')) {
            $.post('api/deletedatamaint', {
                    data: key_,
                },
                function (data, status) {
                    console.log(data.data)
    
                    if (data.data === 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Delete Data.'
                        });
                        viewdata();
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Gagal Delete.'
                        })
                    }
                })
        } else {
            return false;
        }
    });

    $(document).on(\"click\", \".deletetracking\", function () {	
        var key_ = $(this).data('id');
            if (confirm('Are you sure you want to delete this?')) {
                $.post('api/deletedatatracking', {
                        data: key_,
                    },
                    function (data, status) {
                        console.log(data.data)
        
                        if (data.data === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Delete Data.'
                            });
                            viewdatatracking();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Gagal Delete.'
                            })
                        }
                    })
            } else {
                return false;
            }
        });

        $(document).on(\"click\", \".deletecalibration\", function () {	
            var key_ = $(this).data('id');
                if (confirm('Are you sure you want to delete this?')) {
                    $.post('api/deletedatacalibration', {
                            data: key_,
                        },
                        function (data, status) {
                            console.log(data.data)
            
                            if (data.data === 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Berhasil Delete Data.'
                                });
                                viewdatacalibration();
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Gagal Delete.'
                                })
                            }
                        })
                } else {
                    return false;
                }
            });

            $(document).on(\"click\", \".deleterepair\", function () {	
                var key_ = $(this).data('id');
                    if (confirm('Are you sure you want to delete this?')) {
                        $.post('api/deletedatarepair', {
                                data: key_,
                            },
                            function (data, status) {
                                console.log(data.data)
                
                                if (data.data === 'success') {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Berhasil Delete Data.'
                                    });
                                    viewdatarepair();
                                } else {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Gagal Delete.'
                                    })
                                }
                            })
                    } else {
                        return false;
                    }
                });
                $(document).on(\"click\", \".deleteacessories\", function () {	
                    var key_ = $(this).data('id');
                        if (confirm('Are you sure you want to delete this?')) {
                            $.post('api/deletedataacessories', {
                                    data: key_,
                                },
                                function (data, status) {
                                    console.log(data.data)
                    
                                    if (data.data === 'success') {
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Berhasil Delete Data.'
                                        });
                                        viewdataacessories();
                                    } else {
                                        Toast.fire({
                                            icon: 'warning',
                                            title: 'Gagal Delete.'
                                        })
                                    }
                                })
                        } else {
                            return false;
                        }
                    });

");

$this->registerJs("
function viewdata() {
    $('.maintainenance').remove();
    $.ajax({
        type: 'POST',
        url: 'api/alkesmaintenance',
        cache: false,
        method: 'POST',
        data: {
            id: '$model->codeAset',

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#maintenancex').html(response.datanya);


                $('#otherx').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
                 $( '.fa-trash' ).remove();

            }
        },
        failure: function(response) {
            Swal.fire(
                'Internal Error',
                'Oops, your Data was not Found.', // had a missing comma
                'error'
            )
        }
    });
}

function viewdatatracking() {
    $('.tracking').remove();
    $.ajax({
        type: 'POST',
        url: 'api/alkestracking',
        cache: false,
        method: 'POST',
        data: {
            id: '$model->codeAset',

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#trackingx').html(response.datanya);
                $('#trackingtable').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
                 $( '.fa-trash' ).remove();

            }
        },
        failure: function(response) {
            Swal.fire(
                'Internal Error',
                'Oops, your Data was not Found.', // had a missing comma
                'error'
            )
        }
    });
}

function viewdatacalibration() {
    $('.calibration').remove();
    $.ajax({
        type: 'POST',
        url: 'api/alkescalibration',
        cache: false,
        method: 'POST',
        data: {
            id: '$model->codeAset',

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#calibrationx').html(response.datanya);
                $('#calibrationtable').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
                 $( '.fa-trash' ).remove();

            }
        },
        failure: function(response) {
            Swal.fire(
                'Internal Error',
                'Oops, your Data was not Found.', // had a missing comma
                'error'
            )
        }
    });
}

function viewdatarepair() {
    $('.repair').remove();
    $.ajax({
        type: 'POST',
        url: 'api/alkesrepair',
        cache: false,
        method: 'POST',
        data: {
            id: '$model->codeAset',

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#repairx').html(response.datanya);
                $('#repairtable').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
                 $( '.fa-trash' ).remove();

            }
        },
        failure: function(response) {
            Swal.fire(
                'Internal Error',
                'Oops, your Data was not Found.', // had a missing comma
                'error'
            )
        }
    });
}

function viewdataacessories() {
    $('.acessories').remove();
    $.ajax({
        type: 'POST',
        url: 'api/alkesacessories',
        cache: false,
        method: 'POST',
        data: {
            id: '$model->codeAset',

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#acessoriesx').html(response.datanya);
                $('#acessoriestable').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'Bfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
                 $( '.fa-trash' ).remove();

            }
        },
        failure: function(response) {
            Swal.fire(
                'Internal Error',
                'Oops, your Data was not Found.', // had a missing comma
                'error'
            )
        }
    });
}
", View::POS_END);


?>
<div class="col-12 col-sm-8 col-md-6 col-lg-12">
    <div class="card">
        <div class="card-header">

            <h1><?= Html::encode($this->title) ?></h1>
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-propeties-tab" data-toggle="pill" href="#custom-tabs-four-propeties" role="tab" aria-controls="custom-tabs-four-propeties" aria-selected="true">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Maintenance-tab" data-toggle="pill" href="#custom-tabs-four-Maintenance" role="tab" aria-controls="custom-tabs-four-Maintenance" aria-selected="false">Maintenance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Tracking-tab" data-toggle="pill" href="#custom-tabs-four-Tracking" role="tab" aria-controls="custom-tabs-four-Tracking" aria-selected="false">Tracking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-kalibrasi-tab" data-toggle="pill" href="#custom-tabs-four-kalibrasi" role="tab" aria-controls="custom-tabs-four-kalibrasi" aria-selected="false">Calibration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-repair-tab" data-toggle="pill" href="#custom-tabs-four-repair" role="tab" aria-controls="custom-tabs-four-repair" aria-selected="false">Repair</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-acessories-tab" data-toggle="pill" href="#custom-tabs-four-acessories" role="tab" aria-controls="custom-tabs-four-acessories" aria-selected="false">Acessories</a>
                        </li>
                    </ul>
                </div>
                <style>
                    .table td,
                    .table th {
                        padding: .2rem;
                        vertical-align: top;
                        border-top: 1px solid #dee2e6;
                    }
                </style>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-propeties" role="tabpanel" aria-labelledby="custom-tabs-four-propeties-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'options' => [
                                            'class' => 'table table-striped table-bordered tabel-sm detail-view',
                                            'style' => 'font-size:12px',
                                        ],
                                        'attributes' => [
                                            'codeAset',
                                            'noAsset_SAP',
                                            'noInventory',
                                            'namaAlat',
                                            'merk',
                                            'tipe',
                                            'createdBy',
                                            'modifiedBy',
                                        ],
                                    ]) ?>
                                    <?php
                                    if (strlen($model['pic1']) > 120) {
                                        $gambar = $model['pic1'];
                                        echo "<img src=\"$gambar\" alt=\"pic1\" class =\"img-fluid\">";
                                    } else {
                                        $gambar = $model['pic1'];
                                        echo Html::img('upload/alkeswh/image/' . $gambar, ['alt' => 'pic1', 'class' => 'img-fluid']);
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-4 col-md-6">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'options' => [
                                            'class' => 'table table-striped table-bordered tabel-sm detail-view',
                                            'style' => 'font-size:12px',
                                        ],
                                        'attributes' => [
                                            'noSeri',
                                            'lokasi',
                                            'tglBeli',
                                            'tglKalibrasi',
                                            'Supplier',
                                            'kondisi',
                                            'createdTime',
                                            'modifiedTime',
                                        ],
                                    ]) ?>
                                    <?php
                                    if (strlen($model['pic2']) > 120) {
                                        $gambar = $model['pic2'];
                                        echo "<img src=\"$gambar\" alt=\"pic2\" class =\"img-fluid\">";
                                    } else {
                                        $gambar = $model['pic2'];
                                        echo Html::img('upload/alkeswh/image/' . $gambar, ['alt' => 'pic2', 'class' => 'img-fluid']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-Maintenance" role="tabpanel" aria-labelledby="custom-tabs-four-Maintenance-tab">
                            <button type="button" class="btn btn-primary btn-xs cari mb-3" data-toggle="modal" data-target=".sasset" title="Search Asset"><i class="fas fa-plus"></i> Add</button>
                            <div id="maintenancex">

                            </div>

                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-Tracking" role="tabpanel" aria-labelledby="custom-tabs-four-Tracking-tab">
                            <button type="button" class="btn btn-primary btn-xs trackingx mb-3" data-toggle="modal" data-target=".trackingmodals" title="Input Data Tracking"><i class="fas fa-plus"></i> Add</button>

                            <div id="trackingx">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-kalibrasi" role="tabpanel" aria-labelledby="custom-tabs-four-kalibrasi-tab">
                            <button type="button" class="btn btn-primary btn-xs kalibrasix mb-3" data-toggle="modal" data-target=".calibrationmodals" title="Input Data Kalibrasi"><i class="fas fa-plus"></i> Add</button>

                            <div id="calibrationx">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-repair" role="tabpanel" aria-labelledby="custom-tabs-four-repair-tab">
                            <button type="button" class="btn btn-primary btn-xs repairx mb-3" data-toggle="modal" data-target=".repairmodals" title="Input Data Repair"><i class="fas fa-plus"></i> Add</button>


                            <div id="repairx">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-acessories" role="tabpanel" aria-labelledby="custom-tabs-four-acessories-tab">
                            <button type="button" class="btn btn-primary btn-xs acessoriesbtn mb-3" data-toggle="modal" data-target=".acessoriesmodals" title="Input Data Acessories"><i class="fas fa-plus"></i> Add</button>

                            <div id="acessoriesx">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>






<!-- ------------ MODAL ADD Maintenance------------------>
<div class="modal fade sasset" tabindex="-1" id="modal-maint">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Maintenance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="maint">
                    <div class="form-group">
                        <label for="Maintenance">Tanggal Maintenance</label>
                        <input type="text" class="form-control datex" id="tgl_maint" name="tgl_maint" placeholder="Masukan Tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Maintenance" required>
                    </div>
                    <div class="form-group">
                        <label for="Teknisi">Teknisi</label>
                        <input type="text" class="form-control" id="teknisi" name="teknisi" placeholder="Teknisi Maintenance" required>
                    </div>
                    <div class="form-group">
                        <label for="nolk">No. Service Report</label>
                        <input type="text" class="form-control" id="nosr" name="nosr" placeholder="No Service Report" required>
                    </div>
                    <div class="form-group">
                        <label for="hasil">Hasil</label>
                        <input type="text" class="form-control" id="hasil" name="hasil" placeholder="Hasil Maintenance" required>
                    </div>
                    <div class="form-group">
                        <label for="hasil">Action Plan</label>
                        <input type="text" class="form-control" id="actionplan" name="actionplan" placeholder="Action Plan Maintenance" required>
                    </div>
                    <input type="hidden" class="form-control" id="codeAset" name="codeAset" value="<?php echo $model->codeAset; ?>">

                    <div class="card-footer">
                        <button type="submit" id="submaint" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD Maintenance ------------------>



<!-- ------------ MODAL ADD Tracking Barang------------------>
<div class="modal fade trackingmodals" tabindex="-1" id="modal-tracking">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Tracking Barang [ <?php echo $model->codeAset ?> ]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="tarckingsubmit">
                    <div class="form-group">
                        <label for="jenis">Status Barang</label>
                        <input type="text" class="form-control" id="stsbrg" name="stsbrg" placeholder="Status Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="Teknisi">Nomer Inventory Transfer </label>
                        <input type="text" class="form-control" id="nit" name="nit" placeholder="Nomer Inventory Transfer ">
                    </div>
                    <div class="form-group">
                        <label for="nolk">Tanggal Pengiriman</label>
                        <input type="text" class="form-control datex" id="tglkirim" name="tglkirim" placeholder="Tanggal Pengiriman">
                    </div>
                    <div class="form-group">
                        <label for="hasil">Tanggal Penerimaan</label>
                        <input type="text" class="form-control datex" id="tglpnrm" name="tglpnrm" placeholder="Tanggal Penerimaan">
                    </div>
                    <div class="form-group">
                        <label for="hasil">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan....." required>
                    </div>
                    <input type="hidden" class="form-control" id="codeAsettracking" name="codeAsettracking" value="<?php echo $model->codeAset; ?>">
                    <div class="card-footer">
                        <button type="submit" id="subtracking" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD Tracking Barang ------------------>


<!-- ------------ MODAL ADD Calibration Barang------------------>
<div class="modal fade calibrationmodals" tabindex="-1" id="modal-calibration">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Calibration Barang [ <?php echo $model->codeAset ?> ]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="calibrationsubmit">
                    <div class="form-group">
                        <label for="jenis">Tanggal Kalibrasi</label>
                        <input type="text" class="form-control datex" id="tgl_kalibrasi" name="tgl_kalibrasi" placeholder="Tanggal Kalibrasi" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Tanggal Habis Masa Kalibrasi</label>
                        <input type="text" class="form-control datex" id="tgl_endkalibrasi" name="tgl_endkalibrasi" placeholder="Tanggal Berkahir Masa Kalibrasi" required>
                    </div>
                    <div class="form-group">
                        <label for="Teknisi">Institusi </label>
                        <input type="text" class="form-control" id="institusi" name="institusi" placeholder="Institusi ">
                    </div>
                    <div class="form-group">
                        <label for="nolk">No Sertifikat</label>
                        <input type="text" class="form-control" id="nosrtifikat" name="nosrtifikat" placeholder="No Sertifikat">
                    </div>
                    <div class="form-group">
                        <label for="hasil">Hasil</label>
                        <input type="text" class="form-control" id="hasilcalibration" name="hasilcalibration" placeholder="Hasil">
                    </div>
                    <div class="form-group">
                        <label for="hasil">Sertfikat Document</label>
                        <input type="file" class="form-control" id="docupload" name="docupload">
                    </div>
                    <input type="hidden" class="form-control" id="codeAsetcalibration" name="codeAsetcalibration" value="<?php echo $model->codeAset; ?>">
                    <div class="card-footer">
                        <button type="submit" id="subcalibration" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD Calibration Barang ------------------>


<!-- ------------ MODAL ADD Repair Barang------------------>
<div class="modal fade repairmodals" tabindex="-1" id="modal-repair">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Repair Barang [ <?php echo $model->codeAset ?> ]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="repairsubmit">
                    <div class="form-group">
                        <label for="jenis">Tanggal Repair</label>
                        <input type="text" class="form-control datex" id="tgl_repair" name="tgl_repair" placeholder="Tanggal Repair" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Keluhan</label>
                        <input type="text" class="form-control" id="keluhan" name="keluhan" placeholder="Keluhan" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Teknisi</label>
                        <input type="text" class="form-control" id="teknisirepair" name="teknisirepair" placeholder="Teknisi" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Hasil</label>
                        <input type="text" class="form-control" id="hasilrepair" name="hasilrepair" placeholder="Hasil" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Sparepart</label>
                        <input type="text" class="form-control" id="sparepart" name="sparepart" placeholder="Sparepart" required>
                    </div>
                    <input type="hidden" class="form-control" id="codeAsetrepair" name="codeAsetrepair" value="<?php echo $model->codeAset; ?>">
                    <div class="card-footer">
                        <button type="submit" id="subrepair" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD Repair Barang ------------------>



<!-- ------------ MODAL ADD Repair Barang------------------>
<div class="modal fade acessoriesmodals" tabindex="-1" id="modal-acessories">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Acessories Barang [ <?php echo $model->codeAset ?> ]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="acessoriessubmit">
                    <div class="form-group">
                        <label for="jenis">Acessories</label>
                        <input type="text" class="form-control" id="acessoriesname" name="acessoriesname" placeholder="Acessories" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Keterangan</label>
                        <input type="text" class="form-control" id="keteranganacessories" name="keteranganacessories" placeholder="Keterangan" required>
                    </div>
                    <input type="hidden" class="form-control" id="codeAsetacessories" name="codeAsetacessories" value="<?php echo $model->codeAset; ?>">
                    <div class="card-footer">
                        <button type="submit" id="subacessories" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- ------------ /MODAL ADD Repair Barang ------------------>