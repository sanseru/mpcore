<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

$root = '@web';
$this->registerJsFile($root."/inc/apiTable.js",
['depends' => [\frontend\assets\AppAsset::className()],
'position' => View::POS_END]);

$this->registerJs("
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
$('#control_sidebar').addClass('sidebar-collapse');
    tableApiServerSide('.assetwh', 'api/batchinginv');
    // button view
    $(document).on(\"click\", \"#viewx\", function () {	
        var batch = $(this).data(\"id\")
        console.log(batch)
        $.post('api/batch-preview', {
            data: batch,
        },
        function (data, status) {
        $('#tablenya').html(data);
            
        })
    });
    //  End Button View
    // Button Kirim Email
    $(document).on(\"click\", \"#sentemail\", function () {	
      var batch = $(this).data(\"idx\")
      alert(batch)
      $.post('api/kirim-einv', {
          data: batch,
      },
      function (data, status) {
        if(data.data === 'success'){
          Toast.fire({
                  icon: 'success',
                  title: 'Berhasil Mengirim.'
                })
      }else{
          Toast.fire({
              icon: 'warning',
              title: 'Gagal Menyimpan.'
            })
      }          
      })
    });
    // End Button Email
");


?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoice Batching</h3>
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
                    <th>No Batch</th>
                    <th>Perusahaan</th>
                    <th>Tanggal Input</th>
                    <th>Status</th>
                    <th>Action</th>


            </thead>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mw-100 w-75" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="tablenya">
        ...
      </div>
    </div>
  </div>
</div>