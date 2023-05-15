<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModelInvTrackHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Model Inv Track Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$active = 'class=active';
$active2 = 'class=batal';

?>
<div class="card ">
    <div class="card-header">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'perusahaan',
                            'noinvoice',
                            'invStatus.status',
                            'created_by',
                            'created_time',
                        ],
                    ]) ?>
                </div>
            </div>
            <style>
            .progressbar-wrapper {
      background: #fff;
      width: 100%;
      padding-top: 10px;
      padding-bottom: 5px;
}

.progressbar li {
      list-style-type: none;
      width: 20%;
      float: left;
      font-size: 12px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
}
.progressbar li:before {
    width: 60px;
    height: 60px;
    content: "";
    line-height: 60px;
    border: 2px solid #7d7d7d;
    display: block;
    text-align: center;
    margin: 0 auto 3px auto;
    border-radius: 50%;
    position: relative;
    z-index: 2;
    background-color: #fff;
}
.progressbar li:after {
     width: 100%;
     height: 2px;
     content: '';
     position: absolute;
     background-color: #7d7d7d;
     top: 30px;
     left: -50%;
     z-index: 0;
}
.progressbar li:first-child:after {
     content: none;
}
.progressbar li.active {
    color: green;
    font-weight: bold;  
}
.progressbar li.active:before {
    border-color: #55b776;
    background: green;
 }
.progressbar li.active + li:after {
    background-color: #55b776;
}

.progressbar li.batal {
    color: red;
    font-weight: bold;  
}
.progressbar li.batal:before {
    border-color: #55b776;
    background: red;
 }
            </style>
            <div class="row">
            <div class="progressbar-wrapper">
                <ul class="progressbar">
                    <li <?php echo (($model->status == 5) ? $active2  : ''); ?> style="color:red" > Cancel</li>
                    <li <?php echo (($model->status >= 1 && $model->status != 5 ) ? $active  : ''); ?> >Manifested</li>
                    <li <?php echo (($model->status >= 2 && $model->status != 5) ? $active  : ''); ?> >On Process</li>
                    <li <?php echo (($model->status >= 3 && $model->status != 5) ? $active  : ''); ?> >Delivered</li>
                    <li <?php echo (($model->status >= 4 && $model->status != 5) ? $active  : ''); ?> >Confirm By User</li>
                </ul>
            </div>
            </div>
            <div class="container-fluid">

                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->

                            <?php 
                            foreach($detail as $details):
                                if($details->photo){
                                    $photo = "<div class='timeline-body'>
                                    ".Html::img('@web/images/img/'.$details->photo, [

                                        'alt' => 'Invoice',
                                    
                                        'width' => '120px',
                                    
                                        'height' => '160px'
                                    
                                      ])."
                                  </div>";
                                }else{
                                    $photo ="";
                                }
                                echo "
                                <div class='time-label'>
                                <span class='bg-info'>".date('d-M-Y', strtotime($details->createdTime))."</span>
                            </div>
                            <div>
                                <i class='fas fa-user bg-green'></i>
                                <div class='timeline-item'>
                                    <span class='time'><i class='fas fa-clock'>".date('d-M-Y H:i:s', strtotime($details->createdTime))."</i></span>
                                    <h3 class='timeline-header no-border'>".$details->description." diterima ".$details->name."</h3>
                                    ".$photo."
                                </div>
                            </div>
                                ";
                            endforeach; 
                            ?>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                </div>
            </div>
        </div>
    </div>
</div>
