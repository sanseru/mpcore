<?php

use yii\helpers\Html;
use frontend\models\ModelMenu;
use frontend\models\ModelSubmenu;
use frontend\models\Menuakses;
use frontend\models\ModelMenuakses;

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm nav-flat nav-child-indent">
  <!-- Brand Logo -->
  <a href="<?= $baseUrl ?>" class="brand-link">
    <img src="<?= $baseUrl ?>/adminlte/dist/img/MP_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold">Medikaplaza</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $baseUrl ?>/adminlte/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= Yii::$app->homeUrl; ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <?php
        if (!Yii::$app->user->isGuest) {
          $menu = ModelMenu::find()
            ->where(['flag' => 1])
            ->orderBy(['idmenu' => SORT_ASC])
            ->all();
          $sub = '';
          foreach ($menu as $menus) :

            $privileges = ModelMenuakses::find()
              ->where(['like', 'menu_name', $menus->nama_menu])
              ->AndWhere(['description' => 'HEAD'])
              ->AndWhere(['idrole' => Yii::$app->user->identity->role])
              ->One();

            if ($privileges) {
              if ($privileges->flag == 1) {
                $checks = 1;
              } else {
                $checks = 0;
              }


              $child = ModelSubmenu::find()->where(['parent_id' => $menus->idmenu])->AndWhere(['flag' => 1])->all();
              $subChild = '';
              foreach ($child as $childs) :
                $privilege = ModelMenuakses::find()
                  ->where(['like', 'menu_name', $childs->nama_menu])
                  ->AndWhere(['description' => 'CHILD'])
                  ->AndWhere(['idrole' => Yii::$app->user->identity->role])
                  ->One();
                if ($privilege) {

                  if ($privilege->flag == 1) {
                    $check = 1;
                  } else {
                    $check = 0;
                  }
                  if ($check == 1) {
                    $subChild .= '<li class="nav-item">
                      <a href="' . $childs->link . '"class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>' . $childs->nama_menu . '</p>
                      </a>
                      </li>';
                  }
                }
              endforeach;
              if ($checks == 1) {
                if ($menus->link != '#') {
                  $sub .= '<li class="nav-item">
                               <a href="' . $menus->link . '" class="nav-link">
                               <i class="nav-icon fas ' . $menus->icon . '"></i>
                               <p>
                               ' . $menus->nama_menu . '
                               <span class="right badge badge-danger">New</span>
                               </p>
                               </a>';
                } else {
                  $sub .= '<li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas ' . $menus->icon . '"></i>
                        <p>
                        ' . $menus->nama_menu . '
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        ' . $subChild . '
                      </ul>
                    </li>';
                }
              }
            }
          endforeach;
        ?>
          <?= $sub; ?>
          <li class="nav-item">
            <?= Html::a(' <i class="nav-icon fas fa-cube"></i><p>App Asset Manajemen WH</p>', ['/alkesuser.wh'], ['class' => 'nav-link']) ?>
          </li>
          <li class="nav-item">
            <?= Html::a(' <i class="nav-icon fas fa-truck"></i><p>Kirim Barang/Berkas</p>', ['/kurir/index'], ['class' => 'nav-link']) ?>
          </li>
          <li class="nav-item">
            <?= Html::a(' <i class="nav-icon fas fa-sign-out-alt"></i><p>Signout</p>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  <?php } ?>

  </div>
  <!-- /.sidebar -->
</aside>