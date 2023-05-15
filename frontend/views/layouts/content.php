<?php

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use common\widgets\Alert;

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
      <div class="row mb-1">
        <div class="ml-auto mr-3">
          <?= Breadcrumbs::widget([
            'itemTemplate' => "\n\t<li class=\"breadcrumb-item float-right\"><i>{link}</i></li>\n", // template for all links
            'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
  <?= Alert::widget() ?>
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?= $content ?>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->