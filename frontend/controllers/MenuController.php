<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ModelMenu;
use frontend\models\ModelMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ModelSubmenu;
use frontend\models\ModelSubmenuSearch;
use yii\filters\AccessControl;
/**
 * MenuController implements the CRUD actions for ModelMenu model.
 */
class MenuController extends Controller
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
     * Lists all ModelMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModelMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionSubmenu($id){
        $searchModel = new ModelSubmenuSearch();
        $dataProvider = $searchModel->search($id);

        return $this->render('submenu',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$this->findModel($id),
        ]);

    }

    /**
     * Displays a single ModelMenu model.
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
     * Creates a new ModelMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModelMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data saved!");
            return $this->redirect(['view', 'id' => $model->idmenu]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreated($id){
        $model = new ModelSubmenu();
        $mode = ModelMenu::findOne($id);                

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['submenu', 'id' => $mode->idmenu]);
        }

        return $this->render('created', [
            'model' => $model,
            'mode'=>$mode
        ]);
    }

    /**
     * Updates an existing ModelMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idmenu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdated($id){
   
        $model = ModelSubmenu::find()
                ->where(['idchild'=>$id])
                ->One();
        
        $mode = ModelMenu::findOne($model->parent_id); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['detail', 'id' => $mode->idmenu]);
        }

        return $this->render('updated', [
            'model' => $model,
            'mode'=>$mode
        ]);
    }

    /**
     * Deletes an existing ModelMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSubDelete($id)
    {
        $this->findSubModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ModelMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModelMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModelMenu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findSubModel($id)
    {
        if (($model = ModelSubmenu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
