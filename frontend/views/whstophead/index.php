<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelWarehouseStockOPHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Opname';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-12 col-sm-8 col-md-6 col-lg-12">

<div class="card">
<div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create SPK Opname', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'options' => [
            'class' => 'table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'idStockOP',
                'format' => 'raw',
                'value'=> function ($model) {
                    return Html::a('<center><b>'. $model->idStockOP . '</center>',['whstophead/opname','id'=>$model->id,'code'=>$model->idStockOP],['class'=>'policy']);
                },
            ],
            [
                'label'=>'Lokasi Gudang',
                'attribute'=>'lokasi',
                'value'=> 'gudangWh.name',
            ],
            'tanggal_mulai',
            'keterangan:ntext',
            //'status',
            //'createdBy',
            //'createdTime',
            //'ModifiedBy',
            //'ModifiedTime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{export}',
            'buttons' => [
                'export' => function ($url, $model) {
                    return Html::a('&nbsp&nbsp<span class="fas fa-file-excel">&nbsp&nbsp</span>', ['/whstophead/excelldownloadsum','id'=>$model->id,'code'=>$model->idStockOP], ['title' => Yii::t('app', 'Export')]);
                },
            ]
        ],
        ],
    ]); ?>


</div>
</div>
</div>