<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

$root = '@web';
$this->registerJsFile($root."/inc/apiTable.js",
['depends' => [\frontend\assets\AppAsset::className()],
'position' => View::POS_END]);

$this->registerCss("
    .cls{
        cursor:pointer;
    }
");
$this->registerJs("
    $('#control_sidebar').addClass('sidebar-collapse');
    tableApiServerSideExcell('.assetnyagani','api/assetmp');
    $.ajax({
        url: 'api/statusaset',
        type: 'get',
        success: function(data) {
            console.log(data)
            $('.NB').text(data.NB[0].jumlah);
            $('.PC').text(data.PC[0].jumlah);
            $('.BOP').text(data.BOP[0].jumlah);
            $('.ANX').text(data.ANX[0].jumlah);
            $('.WTC').text(data.WTC[0].jumlah);
            var jumlah = +data.NB[0].jumlah + +data.PC[0].jumlah;
            $('.JUMLAHALL').text(jumlah);

        }
    });
");


$this->registerJs("

function executecls(){
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won`t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function () {
        $.ajax({
            type: 'POST',
            url: 'api/cls',
            cache: false,
            success: function(response) {
                Swal.fire(
                'Success!',
                'Your CLS has been saved! Data Yang Di Delete ' + response.data,
                'success'
                )
            },
            failure: function (response) {
                Swal.fire(
                'Internal Error',
                'Oops, your CLS was not saved.', // had a missing comma
                'error'
                )
            }
        });

      })
}
",View::POS_END);

?>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-laptop"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Notebook</span>
                        <span class="info-box-number NB"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-laptop"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Desktop</span>
                        <span class="info-box-number PC"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Gedung BOP</span>
                        <span class="info-box-number BOP"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Gedung ANX</span>
                        <span class="info-box-number ANX"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Gedung WTC</span>
                        <span class="info-box-number WTC"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-laptop"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah</span>
                        <span class="info-box-number JUMLAHALL"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            </div>
        <!-- /.row -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assetnya Gani Nih</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active cls" onclick="executecls('ajaxRequest')">Clear Double</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive assetnyagani table-sm w-auto small"
                    style="font-size:60%" style="width:100%">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Host Name</th>
                            <th>OS</th>
                            <th>Domain</th>
                            <th>Logon Server</th>
                            <th>IP Address</th>
                            <th>CPU</th>
                            <th>Memory</th>
                            <th>Boot Time</th>
                            <th>Volume</th>
                            <th>Free Space</th>
                            <th>Services Tag</th>
                            <th>Manufacturer</th>
                            <th>Version Product</th>
                            <th>Created Time</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
