<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MasTblMenu */

$this->title = 'Update Master Menu: ' . $model->nama_menu;
$this->params['breadcrumbs'][] = ['label' => 'Master Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mode->nama_menu, 'url' => ['detail' ,'id' => $model->parent_id]];
$this->params['breadcrumbs'][] = 'Update - '.$model->nama_menu;
?>
<div class="mas-tbl-menu-update card card-block">


    <?= $this->render('_formd', [
        'model' => $model,
        'mode'=>$mode
    ]) ?>

</div>
