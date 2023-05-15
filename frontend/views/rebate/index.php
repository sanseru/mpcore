<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;


$this->registerJs("
$(document).ready(function () {
    bsCustomFileInput.init();
    viewdataupload()

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    $(document).on(\"click\", \".delete\", function () {	
        var key_ = $(this).data('id');
        console.log(key_);
            if (confirm('Are you sure you want to delete this?')) {
                $.post('api/deletedatarebat', {
                        data: key_,
                    },
                    function (data, status) {
                        console.log(data.data)
        
                        if (data.data === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Delete Data.'
                            });
                            viewdataupload();
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

  });

  
");
$this->registerCss("
    .cls, .delete{
        cursor:pointer;
    }
");


$this->registerJs("
function viewdataupload() {

    $('#datauplaodir').remove();
    
    $('#dataupload').hide();

    $('#lodingss').show();
    $.ajax({
        type: 'POST',
        url: 'api/uploadrebatedata',
        cache: false,
        data: {
            data:0
        },
        method: 'POST',
        success: function(response) {
            if (response.datanya == 'kosong') {
                var data = '<p>Data Masih Kosong</p>'
                $('#header').html(data);
            } else {
                $('#lodingss').hide();
                $('#dataupload').show();
                $('#dataupload').html(response.datanya);
                $('#datauplaodir').DataTable({
                    'responsive': true,
                    'autoWidth': false,
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
?>
<h1>Upload</h1>

<p>

<?php  $form = ActiveForm::begin([
            'options'=>[
                    'enctype'=>'multipart/form-data',
                    ]			
                ]); 
         ?>
<div class="card card-body">
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <?= Html::submitButton('<i class="fas fa-upload"></i> Upload', ['class' => 'btn btn-warning']) ?>

            </div>
        </div>
    </div>
</div>


<div class="card card-body">
<h1 class="text-center">Data History Upload</h1>
    <div class="table-responsive rebatex" id='dataupload'>
    </div>
</div>

<?php ActiveForm::end(); ?>
