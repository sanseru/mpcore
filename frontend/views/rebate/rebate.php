<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

$this->title = 'Rebate';


$this->registerJs("
$(document).ready(function () {
    bsCustomFileInput.init();


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

    $('#lodingss').hide();
    // $('#lodingss').show();


  });
");

$this->registerJs("
function viewdatarebate() {
    var dari = $('#dari').val();
    var sampai = $('#sampai').val();
    $('.rebate').remove();
    $('#rebatetable').remove();
    
    $('#rebatex').hide();

    $('#lodingss').show();
    $.ajax({
        type: 'POST',
        url: 'api/sumrebate',
        cache: false,
        method: 'POST',
        data: {
            dari: dari,
            sampai: sampai,

        },
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#lodingss').hide();
                $('#rebatex').show();
                $('#rebatex').html(response.datanya);
                $('#rebatetable').DataTable({
                    'responsive': true,
                    'autoWidth': false,
                    'dom': 'lBfrtip',
                    'buttons': [
                        'excel',
                    ]
                  });
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

$this->registerJs("
$(document).on(\"click\", \".carix\", function () {	
    var dari = $('#dari').val();
    var sampai = $('#sampai').val();
    console.log(dari);
    if(dari === '' || sampai === ''){
        alert('Masukan Tanggal Dahulu');
    }else{
    viewdatarebate();
    }
})
");


?>
<div class="card card-body">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="exampleInputEmail1">Paid Date From</label>
                <input type="text" class="form-control datex" id="dari" name="dari" placeholder="Paid Date">
            </div>
            <div class="col-md-6 form-group">
                <label for="exampleInputPassword1">Paid Date To</label>
                <input type="text" class="form-control datex" id="sampai" name="sampai" placeholder="Paid Date">
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-sm float-right carix">Search</button>

    </div>
    <div class="loading-container" id='lodingss'>
            <div class="loading"></div>
            <div id="loading-text">loading</div>
    </div>

    <div class="table-responsive rebatex" id='rebatex'>
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