
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelWarehouseStockOPHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Opname';
$this->registerCss("
    .cls, .delete{
        cursor:pointer;
    }
");
$this->registerJs("

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


$(document).ready(function () {
    if($model->status == 2){
        $(':button').prop('disabled', true); // Disable all the buttons
        $('#deletex').remove();
        $('#deletex').removeClass('delete');
        $('#qr-reader').remove();
        $('#submitopname').remove();
        $('.enterdata').remove();
    }

    $('.expdate').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        startDate: moment(),
        showDropdowns: true,
        autoApply: 'true',
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear',
        }
    }, function (chosen_date) {
        $(this.element[0]).val(chosen_date.format('YYYY-MM-DD'));
    })
});

$('#submitopname').on('submit', function (e) {
    var formData = new FormData(this);
    $.ajax({
        url: 'api/opnameinsertdata',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            // alert('masuk');
            console.log(data)
            $('#submitopname')[0].reset();
            viewdata();
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Menyimpan.'
              })
              $('#input' ).focus();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});

$('#control_sidebar').addClass('sidebar-collapse');
$(\"#input\" ).on('keypress',function(e) {
    if (e.which == 13) {
        const inp = document.querySelector(\"#input\");
        $('#submitopname')[0].reset();
        inp.value = inp.value.trim(); 
        executedata('ajaxRequest')
        }
    })

$('body').on('paste', 'input, textarea', function (e) {
    $('#submitopname')[0].reset();
    setTimeout(function () {
    const inp = document.querySelector(\"#input\");
        inp.value = inp.value.trim();
    },
    0);
});

document.addEventListener('textInput', function (e) {
hapus = ''
if (e.data.length >= 8) {
    $('#submitopname')[0].reset();
    $('#input').val(hapus);
    const inp = document.querySelector(\"#input\");
        inp.value = inp.value.trim(); setTimeout(function () {
            executedata('ajaxRequest')

        }, 100);

    }
}); 
viewdata();
$(document).on(\"click\", \".delete\", function () {	
var key_ = $(this).data('id');
    if (confirm('Are you sure you want to delete this?')) {
        $.post('api/deletedataopname', {
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
                    $('#input' ).focus();
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

$('#stckreal').keyup(function(){
    var sap = $('#stocksap').val();
    var real = $('#stckreal').val();

    jumlah = sap - real;
    $('#selisih').val(jumlah);

});

");

$this->registerJs("
function viewdata() {
    $('.tableini').remove();
    $.ajax({
        type: 'POST',
        url: 'api/opnameinsert',
        cache: false,
        method: 'POST',
        data: {
            id: $id,
            code: '$code',
            statusx: '$model->status'

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('.tablenya').html(response.datanya);
                $('#otherx').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                  });
                  if($model->status == 2){
                    // $('#deletex').remove();
                    setTimeout(function() { 
                        $('#deletex').removeClass('delete');

                    }, 3000);
                }
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

function executedata() {
    var input = $('#input').val();
    $.ajax({
            type: 'POST',
            url: 'api/opnamesearch',
            cache: false,
            method: 'POST',
            data: {
                data: input
            },
            success: function(response) {
                    if (response.datanya == 'kosong') {
                        var data = '<p>Data Tidak Ditemukan</p>'
                        $('#header').html(data);
                    } else {
                        // console.log(response.datanya)
                        // cekava()
                        document.getElementById(\"itemcode\").value = response.datanya.ItemCode;
                        document.getElementById(\"itemname\").value = response.datanya.ItemName;
                        document.getElementById(\"uom\").value = response.datanya.InvntryUom;
                        document.getElementById(\"stocksap\").value = response.datanya.OnHand;
                        $('#input').val('');
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

function cekava() {
    var input = $('#input').val();
    $.ajax({
        type: 'POST',
        url: 'api/cekavail',
        method: 'POST',
        data: {
            id: $id,
            code: '$code',
            itemcode: input
        },
        success: function(response) {
            if (response.datanya.jumlah > 0) {
                Swal.fire(
                    'Perhatian',
                    'Oops, Data ada yang sama silahkan cek di bawah.', // had a missing comma
                    'warning'
                )
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

",View::POS_END);

?>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-6">
        <div id="qr-reader"></div>

            <div class="form-group enterdata">
                <label for="exampleInputEmail1">Item Code<small> (Press Enter After Input If Manual)</small></label>
                <input type="text" autoFocus="true" class="form-control" id="input" name="input"
                    placeholder="Enter ItemCode">
            </div>
        </div>
    </div>
    <div class="row justify-content-center" id="view">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12">
                    <div class="card">
                        <form role="form" enctype="multipart/form-data" id="submitopname">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Item Code</label>
                                            <input type="text" class="form-control" id="itemcode" name="itemcode"
                                                readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <input type="text" class="form-control" id="itemname" name="itemname"
                                                readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-2">
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" id="uom" name="uom" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Stock In SAP</label>
                                            <input type="text" class="form-control" id="stocksap" name="stocksap"
                                                readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Stock Real</label>
                                            <input type="number" class="form-control" name="stckreal" id="stckreal" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Selisih</label>
                                            <input type="text" class="form-control" name="selisih" id="selisih"
                                                readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Expire Date</label>
                                            <input type="text" class="form-control expdate" name="exp" id="exp">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>No registrasi AKL / NIE</label>
                                            <input type="text" class="form-control" name="noregkes" id="noregkes" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select class="form-control" id="kondisi" name="kondisi" required>
                                                <option value="">-- Select Option --</option>
                                                <option value="Good">Good</option>
                                                <option value="Not Good">Not Good</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="id" value="<?= $id ?>">
                                    <input type="hidden" class="form-control" name="code" value="<?= $code ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row justify-content-center" id="view">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12">
                    <div class="card">
                    <div class="card-header">
                    <?= Html::a('<i class="fa fa-file-excel" aria-hidden="true"></i> Download', ['/whstophead/excelldownload','id'=>$id,'code'=>$code], ['class'=>'btn btn-primary btn-xs float-right']) ?>

                        <div class="card-body">
                        <div class="row invoice-info" id="header">

                        </div></br>
                            <!-- <div class="buy d-flex justify-content-between align-items-center tablenya"> -->
                            <div class="tablenya">

      
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
} 

docReady(function() {

    setInterval(function() {
        lastResult = '';
        console.log(lastResult)
    }, 5000);

    var lastResult = '';
    
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });
    
    function onScanSuccess(qrCodeMessage) {
        if(lastResult != qrCodeMessage){
            lastResult = qrCodeMessage;
            $('#input').val(qrCodeMessage);
            var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
            snd.play();
            setTimeout(function ()
            {
                executedata('ajaxRequest')
            },100);
        }
 
        
    }
    // Optional callback for error, can be ignored.
    function onScanError(qrCodeError) {
        // This callback would be called in case of qr code scan error or setup error.
        // You can avoid this callback completely, as it can be very verbose in nature.
    }
    html5QrcodeScanner.render(onScanSuccess, onScanError);
});
  </script>