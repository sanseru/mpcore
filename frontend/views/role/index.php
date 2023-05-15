<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Model Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card card-header">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Model Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'role_name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>
