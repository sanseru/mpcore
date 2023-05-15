<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelPurchaseRequestHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Request';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$('#control_sidebar').addClass('sidebar-collapse');
$('[data-toggle=\"tooltip\"]').tooltip();

");
?>

<div class="model-purchase-request-head-index card card-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Purchase Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'requester_name',
            'branch_id',
            'department_id',
            'nopr',
            'status',
            'posting_date',
            'required_date',
            'created_by',
            'created_at',
            'update_at',
            'update_by',
            'description:ntext',
            'valid_until',
            'document_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
