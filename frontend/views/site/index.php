<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

$baseUrl = AppAsset::register($this)->baseUrl;

/* @var $this yii\web\View */

$this->title = 'Medika Plaza Core System';


$this->registerJs("
    $(document).ready(function() {
      $('.carousel').carousel({
        interval: 3000
      })
    });
    
");
?>
<style>
    .lockscreen-name {
    font-weight: 600;
    text-align: center;
}
.lockscreen-wrapper {
    margin: 0 auto;
    max-width: 400px;
}
</style>
<div class="site-index">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href=""><b>Medika Plaza</b> Core System</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Medika Plaza Core System (MCS)</div>

  <div class="help-block text-center">
    MCS adalah aplikasi internal medikplaza untuk menjalankan semua proses bisnis medikaplaza </div>
  <div class="text-center">
  </div>
  <div class="text-center">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <?= Html::img('images/co-working.svg', [
          'alt' => 'pic not found',
          'width' => '100%',
          'height' => '10%',
          'class'=>"img-fluid"
          ]);?>
        </div>
        <div class="carousel-item">
          <?= Html::img('images/study.svg', [
          'alt' => 'pic not found',
          'width' => '100%',
          'height' => '10%',
          'class'=>"img-fluid"
          ]);?>
        </div>
        <div class="carousel-item">
          <?= Html::img('images/undraw_Preparation_re_t0ce.svg', [
        'alt' => 'pic not found',
        'width' => '100%',
        'height' => '10%',
        'class'=>"img-fluid"
        ]);?>
        </div>
        <div class="carousel-item">
          <?= Html::img('images/programming.svg', [
        'alt' => 'pic not found',
        'width' => '100%',
        'height' => '10%',
        'class'=>"img-fluid"
        ]);?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.center -->

</div>
