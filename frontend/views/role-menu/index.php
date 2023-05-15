<?php
    use yii\helpers\Html;
    use yii\web\View;

    
    $this->title = 'Role Menu';
    $this->params['breadcrumbs'][] = $this->title;
    $root = '@web';
/* @JS */
    $this->registerJsFile($root."/inc/apiTable.js",
    ['depends' => [\frontend\assets\AppAsset::className()],
    'position' => View::POS_END]);
    $this->registerCssFile($root."/css/styles/app.css");
    $this->registerCssFile($root."/css/styles/app.skins.css");

    $this->registerCss("
        .cari, .add{
            cursor:pointer;
        }
        #list, #submit{
            display:none;
        }
        
    ");
    $this->registerJs("
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      
        function load(key){
            $.post('api/list-menu',{
                data: key
            },
            function(data, status){	

                $('#list').html(data); 
                document.getElementById(\"list\").style.display = \"block\";   
                document.getElementById(\"submit\").style.display = \"block\";   
            });
        }

        $(document).on(\"click\", \".cari\", function () {	
            tableApi('.datatable','api/division');
        });
        
        $(document).on(\"click\", \"#submit\", function () {	
           
            var sList = '';
            $('input[type=checkbox][name=check]').each(function () {
                var sThisVal = (this.checked ? 1 : 0);
                sList += (sList=='' ? sThisVal : ','+ sThisVal);
            });
            var details = '';
            $('input[type=checkbox][name=detail]').each(function () {
                var detailVal = (this.checked ? 1 : 0);
                details += (details=='' ? detailVal : ','+ detailVal);
            });

            $.post('api/post-privilege',{
                master: sList,
                child: details,
                role: $('#idrole').val()
            },
            function(data, status){	                            
                // console.log ('master '+sList+ 'detail '+details);
                var key = $('#idrole').val()+';'+$('#role').val();
                load(key);

                console.log(data.data)
                if(data.data === 'success'){
                    Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Menyimpan.'
                          })
                }else{
                    Toast.fire({
                        icon: 'warning',
                        title: 'Gagal Menyimpan.'
                      })
                }
            })
            
        });


        $(document).on(\"click\", \".add\", function () {	
            $('.divisi').modal('hide');
            var key_ = $(this).data('id');	            
            var myarr = key_.split(';');
            
            document.getElementById(\"idrole\").value = myarr[0];
            document.getElementById(\"role\").value = myarr[1];
           
            load(key_);
            
        });
          
    ");
?>

<div class="card card-block">
    <div class="form-group">
        
        <label>Division</label>


        <div class="input-group">
            <input type="text" name="role"  id="role" class="form-control" readonly />
            <input type="hidden" name="idrole"  id="idrole" class="form-control" readonly/>
            <!-- <span style="border:0px" class="input-group-addon add-on cari"  data-toggle="modal" data-target=".divisi" title="Search Division">
            <i class="fas fa-check"></i>
            </span> -->
            <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat cari" data-toggle="modal" data-target=".divisi" title="Search Division"><i class="fas fa-search"></i></button>
                  </span>
        </div>

    </div>     
</div>


<div class="card card-block" id="list">


    
</div>

<div class="form-group" id="submit">
    <button type="submit" class="btn btn-success">Set Menu</button>    
</div>

<!-- ------------ MODAL ADD DIVISI------------------>
<div class="modal fade divisi" tabindex="-1" id="modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Large Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table table-bordered datatable" style="width:100%">
                  <thead>
                     <tr>
                        <th>
                           Division Name
                        </th>
                        <th>
                           Action
                        </th>
                     </tr>
                  </thead>
               </table>
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
<!-- ------------ /MODAL ADD DIVISI ------------------>