<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Model Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card card-header">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Model Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Menu',
                'attribute'=>'nama_menu',
                'format' => 'raw',
                'value'=>function ($model) {
                 	return Html::a($model->nama_menu,'menu/submenu?id='.$model->idmenu, ['style' => 'background-color:#ffffa0']);
                },
            ],
            'link',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>