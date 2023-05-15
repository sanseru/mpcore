<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelWarehouseStockOPHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kurir Scan Barcode';
$this->registerJs("
$(document).ready(function() {
    $('.detailnya').hide();
});

$('#kirim').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var formData = new FormData(this);
    $('.submitnyaa').attr('disabled', true);
    $.ajax({
        url: 'kurir/insertkurir',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            $('#kirim')[0].reset();
              $('#input' ).focus();
              $('#input' ).val('');
              $('.detailnya').hide();
              Swal.fire(
                'Good job!',
                'Saved',
                'success'
              )
              $('.submitnyaa').removeAttr('disabled');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Insert Gagal');
            $('.submitnyaa').removeAttr('disabled');

        }
    });

}).on('submit', function (e) {

    e.preventDefault();

});

$(\"#input\" ).on('keypress',function(e) {
    if (e.which == 13) {
        const inp = document.querySelector(\"#input\");
        $('#submitopname')[0].reset();
        inp.value = inp.value.trim(); 
        executedata('ajaxRequest')
        }
    })

    $(\"#status\" ).on('change',function(e) {
        let id = $(this).val();
            if(id == 5){
                $('.cancelremakrs').show();
                $('.remarksx').hide();
            }
    })
");
$this->registerJs("
function executedata() {
    $('.detailnya').hide();
    $('.cancelremakrs').hide();
    var input = $('#input').val();
    $.ajax({
            type: 'POST',
            url: 'api/scan-kurir',
            cache: false,
            method: 'POST',
            data: {
                data: input
            },
            success: function(data) {
                // console.log(data)
                        $('.submitnyaa').prop('disabled', false);
                        $('.stattus').prop('disabled', false);
                        $('#remarks').prop('disabled', false);
                        $('#photo').prop('disabled', false);
                        $('.detailnya').show();
                        var newOption = new Option(data.penerima, data.penerima, true, true);
                        $('#penerima').append(newOption).trigger('change');
                        $('#pic').val(data.namapic);
                        $('#nopenerima').val(data.nopenerima);
                        $('#namabarang').val(data.namabarang);
                        $('#alamat').val(data.alamat);
                        $('#catatan').val(data.catatan);
                        $('#pengirim').val(data.pengirim);
                        $('#nopengirim').val(data.nopengirim);
                        $('#status').val(data.status);
                        $('#idx').val(data.id);
                        $('#kuriruser').val(data.kurirnya).trigger('change');
                        if(data.status == 4 || data.status == 5){
                            $('.submitnyaa').prop('disabled', true);
                            $('.stattus').prop('disabled', true);
                            $('#remarks').prop('disabled', true);
                            $('#photo').prop('disabled', true);
                        }
                    },
            failure: function(data) {
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-6">
            <div id="qr-reader"></div>

            <div class="form-group">
                <label for="exampleInputEmail1">No Barcode<small> (Press Enter After Input If Manual)</small></label>
                <input type="text" autoFocus="true" class="form-control"  id="input" name="input" placeholder="Enter ItemCode">
            </div>
        </div>
    </div>

</div>
<div class="card detailnya">
    <div class="card-header">
        <div id="header">
        </div>
        <p class="text-center">
            <i class="fas fa-truck fa-2x"></i>
        </p>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'id' => 'kirim']); ?>
        <input type="hidden" class="form-control form-control-sm" id="idx" name="idx">
        <h5>Data Penerima</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="penerima"><i class="fas fa-user"></i> Penerima</label><br>
                    <select style="width: 100%" class="form-control form-control-sm js-data-example-ajax" id="penerima" name="penerima" readonly></select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="penerima"><i class="fas fa-user"></i> Nama PIC</label>
                    <input type="text" class="form-control form-control-sm" id="pic" name="pic" readonly>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nopenerima"><i class="fas fa-phone"></i> No Penerima</label>
                    <input type="text" class="form-control form-control-sm" id="nopenerima" name="nopenerima" readonly>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="namabarang"><i class="fas fa-box"></i> Nama Barang</label>
                    <input type="text" class="form-control form-control-sm" id="namabarang" name="namabarang" autocomplete="on" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="alamatpenerima"><i class="fa fa-location-arrow" aria-hidden="true"></i> Alamat Penerima</label>
            <textarea type="text" class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Masukan Alamat Yang Lengkap Agara Mudah Dalam melakukan Pengiriman" readonly></textarea>
        </div>
        <div class="form-group">
            <label for="alamatpenerima"><i class="fa fa-pen" aria-hidden="true"></i> Catatan</label>
            <textarea type="text" class="form-control form-control-sm" id="catatan" name="catatan" placeholder="Masukan No Invoice / Medical Record / Yang lainnya" readonly></textarea>
        </div>
        <h5>Data Pengirim</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pengirim">Pengirim</label>
                    <input type="text" class="form-control form-control-sm" id="pengirim" name="pengirim" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pengirim">No Telepon</label>
                    <input type="text" class="form-control form-control-sm" id="nopengirim" name="nopengirim" readonly>
                </div>
            </div>
        </div>
        <h5>Data Admin</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nopenerima"> Status</label>
                        <select style="width: 100%" class="form-control form-control-sm stattus" id="status" name="status">
                            <option>--Select Status--</option>
                            <?php foreach ($status as $key => $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['status']; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
            </div>
            <div class="form-group remarksx">
                <label for="alamatpenerima"><i class="fa fa-pen" aria-hidden="true"></i> Remarks / Catatan</label>
                <textarea type="text" class="form-control form-control-sm" id="remarks" name="remarks" placeholder="Masukan No Invoice / Medical Record / Yang lainnya"></textarea>
            </div>
            <div class="form-group">
                <label for="tambahbbukti"><i class="fa fa-pen" aria-hidden="true"></i> Upload Photo</label>
                <input type="file" class="form-control form-control-sm" id="photo" name="photo">
            </div>
            <div class="form-group cancelremakrs">
                <label for="alamatpenerima"><i class="fa fa-pen" aria-hidden="true"></i> Cancel Remarks / Catatan Dibatalkan</label>
                <textarea type="text" class="form-control form-control-sm" id="catatancancel" name="catatancancel" placeholder="Masukan No Invoice / Medical Record / Yang lainnya"></textarea>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-success submitnyaa']) ?>
            </div>
            <?php ActiveForm::end(); ?>
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
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });

        function onScanSuccess(qrCodeMessage) {
            if (lastResult != qrCodeMessage) {
                lastResult = qrCodeMessage;
                $('#input').val(qrCodeMessage);
                var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
                snd.play();
                setTimeout(function() {
                    executedata('ajaxRequest')
                }, 1000);
            }


        }
        // Optional callback for error, can be ignored.
        function onScanError(qrCodeError) {
            // This callback would be called in case of qr code scan error or setup error.
            // You can avoid this callback completely, as it can be very verbose in nature.
            //https://stackoverflow.com/questions/16835421/how-to-allow-chrome-to-access-my-camera-on-localhost
        }
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    });
</script>