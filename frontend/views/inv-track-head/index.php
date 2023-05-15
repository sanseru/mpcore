<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelInvTrackHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Tracking';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card-header">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Insert Invoice', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Insert Invoice by Upload', ['uploadinvoice'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Report', ['report'], ['class' => 'btn btn-info']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'table-responsive',
        ],
        'rowOptions' => function ($model) {
            if ( $model->status == 4 ) {
                return ['style' => 'background-color: #59e395'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'label'=>'No Invoice',
                'attribute'=>'noinvoice',
                'format' => 'raw',
                'value'=> function ($model) {
                    return Html::a('<center><b>'. $model->noinvoice . '</center>',['inv-track-head/view','id'=>$model->id],['class'=>'policy']);
                },
            ],
            'perusahaan',
            [
                'label'=>'Status',
                'attribute'=>'status_inv',
                'value'=>'invStatus.status',
            ],
            'created_time',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{print}{qrcode}{delete}',
            'buttons' => [
                'print' => function ($url, $model) {
                    $url = Url::to(['inv-track-head/print', 'id' => $model->noinvoice]);
                    return Html::a('&nbsp&nbsp<span class="fas fa-print">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Print'),'target'=>'_blank']);
                },
                'delete' => function ($url, $model) {
                    $url = Url::to(['inv-track-head/delete', 'id' => $model->id]);
                    return Html::a('<span class="fa fa-trash"></span>', $url, [
                        'title'        => 'delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method'  => 'post',
                    ]);
                },
                'qrcode' => function ($url, $model) {
                    $url = Url::to(['inv-track-head/printqr', 'id' => $model->noinvoice]);
                    return Html::a('&nbsp&nbsp<span class="fas fa-qrcode">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Print'),'target'=>'_blank']);

                },
            ],
        ],
        ],
    ]); ?>


    </div>
</div>