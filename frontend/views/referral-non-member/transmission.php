<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transmission';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
            <?= Html::a('Back', ['referral-non-member/index', 'id' => $model->id,'code' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
            </div></br>
            <div class="row">
                <div class="col-12">
                    <h6>
                        <i class="fas fa-globe"></i> Transmission : <?= $model->nama_peserta ?>
                        <small class="float-right" style="font-size: 80 %;"><?= $model->client ?></small>
                    </h6>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    Detail
                    <address>
                        <strong>Tanggal Terima Berkas : <?= $model->tanggal_terima_berkas ?></strong><br>
                        Tanggal Periksan : <?= $model->tanggal_periksa ?><br>
                        Nama RS : <?= $model->nama_rs ?><br>
                        No Gl : <?= $model->client ?><br>
                        Jalur Pembuatan : <?= $model->jalur_pembuatan ?><br>
                        Jumlah : <?= $model->jumlah ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    To
                    <address>
                        <strong>No So : <?= $model->nomer_so ?></strong><br>
                        Nomer PR : <?= $model->nomer_pr ?><br>
                        Nomer PO : <?= $model->nomer_po ?><br>
                        Nomer AP: <?= $model->nomer_ap ?><br>
                    </address>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="pb-3">
                    <?= Html::a('Create Transmission', ['referral-transmission/create', 'id' => $model->id], ['class' => 'btn btn-success float-right']) ?>
                </div></br>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'description:ntext',
                        // 'remainderdate',
                        'assign_to',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->status == 0) {
                                    return "Open";
                                } else {
                                    return "Closed";
                                }
                            },
                        ],
                        'created_by',
                        'created_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                'update' =>  function ($url, $model) {
                                    return Html::a('<i class="fas fa-edit"></i>', ['referral-transmission/update', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'update')
                                    ]);
                                },
                                'view' =>  function ($url, $model) {
                                    return Html::a('<i class="fas fa-eye"></i>', ['referral-transmission/view', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'view')
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fas fa-trash"></i>', ['referral-transmission/delete', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'delete'),
                                        // 'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>