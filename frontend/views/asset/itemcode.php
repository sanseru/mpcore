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
    tableApiServerSide('.assetwh','api/assetwh');
    // $.ajax({
    //     url: 'api/statusaset',
    //     type: 'get',
    //     success: function(data) {
    //         console.log(data)
    //         $('.NB').text(data.NB[0].jumlah);
    //         $('.PC').text(data.PC[0].jumlah);
    //         $('.BOP').text(data.BOP[0].jumlah);
    //         $('.ANX').text(data.ANX[0].jumlah);
    //         $('.WTC').text(data.WTC[0].jumlah);
    //         var jumlah = +data.NB[0].jumlah + +data.PC[0].jumlah;
    //         $('.JUMLAHALL').text(jumlah);

    //     }
    // });
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


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assetnya Warehouse Nih</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered assetwh">
                    <thead>
                        <tr>
                            <th>ItemCode</th>
                            <th>ItemName</th>
                            <th>QTY</th>
                            <th>Action</th>
                    </thead>
                </table>

            </div>
        </div>
