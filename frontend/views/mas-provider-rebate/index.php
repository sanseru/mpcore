<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelMasProviderRebateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provider Rebate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Insert Provider', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'providerName',
            'rebate',
            [
                'label' => 'Is Detail',
                'format' => 'raw',
                'value' => function ($model) {
                    return ($model->isdetail == 1) ? '<small class="badge badge-success">Yes</small>' : '<small class="badge badge-danger">No</small>' ;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
