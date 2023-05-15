<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
// use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
   .login-page{
    /* background-image: url('https://source.unsplash.com/1600x900/?city'); */
    /* background-image: url('/images/pexels-quintin-gellar-313782.jpg'); */
    background-image: url('/images/pedro-lastra-Nyvq2juw4_o-unsplash.jpg');
    background-size: cover;
   } 


</style>
<div class="card">
    <div class="card-body login-card-body">
        <div class="login-logo">
            <a href="https://medservice.medikaplaza.com"><b>Medikaplaza</b></br>Core System</a>
        </div>
      <p class="login-box-msg">Sign in to start your session</p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Error!</h4>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <!-- <div style="color:#999;margin:1em 0">
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            <br>
            Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
        </div> -->

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

