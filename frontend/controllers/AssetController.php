<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AssetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout', 'signup','login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all PERMINTAANPICKUP models.
     * @return mixed
     */
    public function actionIndex()
    {

        return $this->render('index', [

        ]);
    }

    public function actionItemcode()
    {

        return $this->render('itemcode', [

        ]);
    }

    public function actionItemcodesearch()
    {

        return $this->render('itemcodesearch', [

        ]);
    }

    public function actionPrintqrwh($id)
    {
        include Yii::getAlias('@webroot').'/inc/pdf.php';
        printqrwh($id);    }
}
