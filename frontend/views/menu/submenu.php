<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MasTblMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->nama_menu;
$this->params['breadcrumbs'][] = ['label' => 'Master Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="mas-tbl-menu-detail card card-block">    

    <p>
        <?= Html::a(' Add Sub Menu', ['created', 'id' => $model->idmenu], ['class' => 'btn btn-success']) ?>
    </p> 
    <!-- fas fa-plus -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                   
            [
                'label'=>'Menu',
                'attribute'=>'nama_menu'

            ],
            'link',
            [
                'label'=>'Status',
                'format'=>'raw',
                'value'=> function($model){
                    return $model->flag == 1 ? '<span class="tag tag-success">Enable</span>' : '<span class="tag tag-warning">Disable</span>';
                }
            ],
            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}  {subdelete} ',  // the default buttons + your custom button {view} {update} {delete} {myButton}
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a('', ['updated', 'id' => $model->idchild], ['class' => 'fas fa-edit']);
                    },
                    'subdelete' => function($url, $model, $key) {     // render your custom button
                        return Html::a('', ['sub-delete', 'id' => $model->idchild], ['class' => 'fas fa-trash']);
                    }
                ]
            ]
        ],
    ]); ?>

</div>
