<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModelUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Model Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card card-header">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Model User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            'role',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

</div>
