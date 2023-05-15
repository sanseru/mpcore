<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModeWhAssetAlkesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Manajemen Medikaplaza';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('#control_sidebar').addClass('sidebar-collapse');");
?>
<div class="col-12 col-sm-8 col-md-6 col-lg-12">
    <div class="card">
        <div class="card-header">
            <center>
                <h1><?= Html::encode($this->title) ?></h1>
            </center>

            <p> <?= Html::a('Export', ['exportdata'], ['class' => 'btn btn-success btn-sm float-right']) ?>
            <?= Html::a('Scan Barcode', ['scan-barcode-alkes'], ['class' => 'btn btn-info btn-sm float-right mr-2']) ?>

            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'table-responsive table-sm text-center',
                    'style' => 'font-size:12px',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fas fa-eye">&nbsp&nbsp</span>', ['/wh-asset-alkes/view-user', 'id' => $model->id, 'code' => $model->codeAset], ['title' => Yii::t('app', 'Export')]);
                            },
                        ]
                    ],

                    'id',
                    'codeAset',
                    'noAsset_SAP',
                    'noInventory',
                    'namaAlat',
                    'merk',
                    'tipe',
                    'noSeri',
                    'lokasi',
                    'tglBeli',
                    'tglKalibrasi',
                    'tglexpKalibrasi',
                    'Supplier',
                    'kondisi',

                ],
            ]); ?>


        </div>
    </div>
</div>