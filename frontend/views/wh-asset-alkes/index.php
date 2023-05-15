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

            <p>
                <?= Html::a('+ Add', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a('Upload', ['upload'], ['class' => 'btn btn-danger btn-sm']) ?>
                <?= Html::a('Export', ['exportdata'], ['class' => 'btn btn-success btn-sm float-right mr-2']) ?>
                <?= Html::a('Scan Barcode', ['scan-barcode-alkes'], ['class' => 'btn btn-info btn-sm float-right mr-2']) ?>
                <button class="'btn btn-danger btn-sm float-right mr-2 ceklibra" onclick="window.location.href='#expicali'">Cek Expired Kalibrasi</button>

            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'table-responsive table-sm text-center',
                    'style' => 'font-size:11px',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}&nbsp&nbsp{update}{print}',
                        'contentOptions' => ['style' => 'width: 5%;'],
                        'buttons' => [
                            'print' => function ($url, $model) {
                                return Html::a('&nbsp&nbsp<span class="fas fa-qrcode">&nbsp&nbsp</span>', ['/wh-asset-alkes/qrcodeprint', 'id' => $model->id, 'code' => $model->codeAset], ['title' => Yii::t('app', 'Export')]);
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

<div class="row" id="expicali">
    <div class="col-12 col-sm-8 col-md-6">
        <div class="card collapsed-card">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-clock"></i> Expired Calibration (<?= date('d-m-Y') ?> - <?= date('d-m-Y', strtotime("+30 day")); ?> ) </h3>
                <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code Asset</th>
                            <th>Nama Alat</th>
                            <th>Institusi Kalibrasi</th>
                            <th>Lokasi</th>
                            <th>Habis Masa Kalibrasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($calibration as $key => $value) {   ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['codeAsset'] ?></td>
                                <td><?= $value['namaAlat'] ?></td>
                                <td><?= $value['institusi'] ?></td>
                                <td><?= $value['lokasi'] ?></td>
                                <td><?= $value['tgl_endkalibrasi'] ?></td>
                            </tr>
                        <?php  } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>