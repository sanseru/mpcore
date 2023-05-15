<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

$data = $_GET['id'];
$this->registerJs("
$(document).ready(function () {
    viewdataupload()
});
");
$this->registerJs("
function viewdataupload() {

    $('#dataviewupload').remove();
    
    $('#sumdataxx').hide();
    $('#datauploadview').hide();
    const formatRupiah = (money) => {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
        ).format(money);
     }
    $('#lodingss').show();
    $.ajax({
        type: 'POST',
        url: 'api/viewrebateupload',
        cache: false,
        data: {
            data:'$data'
        },
        method: 'POST',
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                console.log(response.detail[0]);
                $('#lodingss').hide();
                $('#datauploadview').show();
                $('#datauploadview').html(response.datanya);
                $('#dataviewupload').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                  });
                $('.charge').html(formatRupiah(response.detail[0]));
                $('.approved').html(formatRupiah(response.detail[1]));
                $('.dimuka').html(formatRupiah(response.detail[2]));
                $('.excess').html(formatRupiah(response.detail[3]));
                $('#sumdataxx').show();

                
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

<div class="card card-body">
    <h3 class="text-center">Data Upload</h3>

    <div class="loading-container" id='lodingss'>
        <div class="loading"></div>
        <div id="loading-text">loading</div>
    </div>
    <div class="table-responsive rebatexview" id='datauploadview'>
    </div>

    <div class="col-lg-4 col-sm-5 ml-auto" id='sumdataxx'>
        <table class="table table-clear">
            <tbody>
                <tr>
                    <td class="left">
                        <strong>Charge</strong>
                    </td>
                    <td class="right charge"></td>
                </tr>
                <tr>
                    <td class="left">
                        <strong>Approved</strong>
                    </td>
                    <td class="right approved"></td>
                </tr>
                <tr>
                    <td class="left">
                        <strong>Bayar Dimuka</strong>
                    </td>
                    <td class="right dimuka"></td>
                </tr>
                <tr>
                    <td class="left">
                        <strong>Excess</strong>
                    </td>
                    <td class="right excess">

                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


<?php 
$this->registerCss("
/* The Loader */

/** BEGIN CSS **/
        @keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-moz-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-webkit-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-o-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-moz-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-webkit-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @-o-keyframes rotate-loading {
            0%  {transform: rotate(0deg);-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); -o-transform: rotate(0deg); -moz-transform: rotate(0deg);}
            100% {transform: rotate(360deg);-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); -o-transform: rotate(360deg); -moz-transform: rotate(360deg);}
        }

        @keyframes loading-text-opacity {
            0%  {opacity: 0}
            20% {opacity: 0}
            50% {opacity: 1}
            100%{opacity: 0}
        }

        @-moz-keyframes loading-text-opacity {
            0%  {opacity: 0}
            20% {opacity: 0}
            50% {opacity: 1}
            100%{opacity: 0}
        }

        @-webkit-keyframes loading-text-opacity {
            0%  {opacity: 0}
            20% {opacity: 0}
            50% {opacity: 1}
            100%{opacity: 0}
        }

        @-o-keyframes loading-text-opacity {
            0%  {opacity: 0}
            20% {opacity: 0}
            50% {opacity: 1}
            100%{opacity: 0}
        }
        .loading-container,
        .loading {
            height: 100px;
            position: relative;
            width: 100px;
            border-radius: 100%;
        }


        .loading-container { margin: 40px auto }

        .loading {
            border: 2px solid transparent;
            border-color: transparent #3f3697 transparent #3f3697;
            -moz-animation: rotate-loading 1.5s linear 0s infinite normal;
            -moz-transform-origin: 50% 50%;
            -o-animation: rotate-loading 1.5s linear 0s infinite normal;
            -o-transform-origin: 50% 50%;
            -webkit-animation: rotate-loading 1.5s linear 0s infinite normal;
            -webkit-transform-origin: 50% 50%;
            animation: rotate-loading 1.5s linear 0s infinite normal;
            transform-origin: 50% 50%;
        }

        .loading-container:hover .loading {
            border-color: transparent #3d84b8 transparent #3d84b8;
        }
        .loading-container:hover .loading,
        .loading-container .loading {
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
        }

        #loading-text {
            -moz-animation: loading-text-opacity 2s linear 0s infinite normal;
            -o-animation: loading-text-opacity 2s linear 0s infinite normal;
            -webkit-animation: loading-text-opacity 2s linear 0s infinite normal;
            animation: loading-text-opacity 2s linear 0s infinite normal;
            color: #3edbf0;
            font-family: 'Helvetica Neue, 'Helvetica', ''arial';
            font-size: 10px;
            font-weight: bold;
            margin-top: 45px;
            opacity: 0;
            position: absolute;
            text-align: center;
            text-transform: uppercase;
            top: 0;
            width: 100px;
        }
");
?>