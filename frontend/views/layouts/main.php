<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

// AppAsset::register($this);
// $asset         = frontend\assets\AppAsset::register($this);
// $baseUrl        =    $asset->baseUrl;
$baseUrl = AppAsset::register($this)->baseUrl;

// var_dump(Yii::$app->controller->action->id);die;
if (Yii::$app->controller->action->id === 'login') { 
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body id="control_sidebar" class="hold-transition sidebar-mini layout-fixed skin-black-light">
<?php $this->beginBody() ?>

<div class="wrap">
<?= $this->render('header.php',['baseUrl' => $baseUrl]) ?>
<?= $this->render('sidebar.php',['baseUrl' => $baseUrl]) ?>
<?= $this->render('content.php',['content' => $content]) ?>
<?= $this->render('footer.php',['baseUrl' => $baseUrl]) ?>
<?= $this->render('right.php',['baseUrl' => $baseUrl]) ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php } ?>