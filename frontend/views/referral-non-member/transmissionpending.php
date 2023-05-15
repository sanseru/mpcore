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
            <?= Html::a('Back', ['referral-non-member/index',], ['class' => 'btn btn-secondary btn-sm']) ?>
            </div></br>
            <!-- /.row -->
            <div class="row">
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