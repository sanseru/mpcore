<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReferralTransmissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Model Referral Transmissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-referral-transmission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Model Referral Transmission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idreferral',
            'description:ntext',
            'remainderdate',
            'status',
            //'created_by',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
