<?php
use yii\helpers\Html;
?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3 control-sidebar-content">
    <h5>User Menu</h5><hr class="mb-2"/>
    <!-- <button type="button" class="btn btn-block bg-gradient-primary btn-xs">Primary</button> -->
    <?= Html::a('Sign out',['/site/logout'],['data-method' => 'post', 'class' => 'btn btn-block bg-gradient-primary btn-xs']) ?>
    </div>
  </aside>
  <!-- /.control-sidebar -->