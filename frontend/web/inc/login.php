<?php

    use yii\base\InvalidParamException;
    use yii\web\BadRequestHttpException;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;

    use yii\web\Controller;
    use common\models\LoginForm;
    use frontend\models\SignupForm;
    use frontend\models\ModelUser;


    function loginAd($model){

        include 'ldap.php';        
        if(LoginLDAP($model->username,$model->password)){

            $lookUp = User::findOne(['username'=>$model->username]);

            if($lookUp){
                return $model->login();   
            }else{
                
                $models = new User();
                $models->username = $model->username;
                $models->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $models->auth_key = Yii::$app->security->generateRandomString();
                $models->password_reset_token = Yii::$app->security->generateRandomString();
                $models->email = $model->username.'@medikaplaza.com';
                $models->created_at = date('Y-m-d H:i:s');
                $models->status = 0;
                $models->role = 0;
                $models->save(false);
                return $model->login();
            }            
        }else{
            return $model->login(); 
        }

      

    }

?>