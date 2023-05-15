<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MasTblMenu */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Master Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mode->nama_menu, 'url' => ['detail','id'=>$mode->idmenu]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mas-tbl-menu-create card card-block">

    <?= $this->render('_formd', [
        'model' => $model,
        'mode' => $mode,
    ]) ?>

</div>
