<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ModelWarehouseStockOPHead;
use frontend\models\ModelWarehouseStockOPHeadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WhstopheadController implements the CRUD actions for ModelWarehouseStockOPHead model.
 */
class WhstopheadController extends Controller
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
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
    
                    // ...
                ],
            ],
        ];
    }

    /**
     * Lists all ModelWarehouseStockOPHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModelWarehouseStockOPHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModelWarehouseStockOPHead model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModelWarehouseStockOPHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModelWarehouseStockOPHead();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            $model->createdTime = date('Y-m-d H:i:s');
            $model->createdBy = Yii::$app->user->identity->username;
            $model->save(false);
            Yii::$app->session->setFlash('success', "Data saved!");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModelWarehouseStockOPHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->ModifiedTime = date('Y-m-d H:i:s');
            $model->ModifiedBy = Yii::$app->user->identity->username;
            $model->save(false);
            Yii::$app->session->setFlash('success', "Data Updated!");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModelWarehouseStockOPHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('danger', "Data Deleted!");

        return $this->redirect(['index']);
    }


    public function actionOpname($id,$code)
    {

        $model = $this->findModel($id);

        return $this->render('opname', [
            'id' => $id,
            'code' => $code,
            'model' => $model,


        ]);
    }

    public function actionExcelldownload($id,$code)
    {
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' ");
        $modelNB = $NB->queryAll();
        include Yii::getAlias('@webroot').'/inc/Export.php';
        ExportReportWHopname($modelNB);
    }

    public function actionExcelldownloadsum($id,$code)
    {
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT itemcode,code_head,id_head FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode is not null AND itemcode <> '' GROUP by itemcode, code_head, id_head");
        $modelNB = $NB->queryAll();
        include Yii::getAlias('@webroot').'/inc/Export.php';
        ExportReportWHopnameSUM($modelNB);
    }

    /**
     * Finds the ModelWarehouseStockOPHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModelWarehouseStockOPHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModelWarehouseStockOPHead::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
