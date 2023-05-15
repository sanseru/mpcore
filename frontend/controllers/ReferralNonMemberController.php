<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ModelReferralNonMemberLog;
use frontend\models\ModelReferralNonMemberLogSearch;
use frontend\models\ReferralTransmissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ReferralNonMemberController implements the CRUD actions for ModelReferralNonMemberLog model.
 */
class ReferralNonMemberController extends Controller
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
     * Lists all ModelReferralNonMemberLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModelReferralNonMemberLog model.
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
     * Creates a new ModelReferralNonMemberLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModelReferralNonMemberLog();

        if ($model->load(Yii::$app->request->post())) {
            $namagabung="";
            $image1 = UploadedFile::getInstances($model, 'document_file');
            if(!empty($image1)){
                foreach ($image1 as $file) {
                    $fileName = uniqid().$file->name;
                    $uploadDir = Yii::getAlias('@webroot/upload/referral/billing/');
                    if(!is_dir("upload/referral/billing/")) {
                        mkdir("upload/referral/billing/", 0777, true);
                    }                                           
                    $file->saveAs($uploadDir.'/'.$fileName);
                    $namagabung .= $fileName.";"; 	
                }

            }
            $model->document_file = $namagabung;
            $model->created_by = Yii::$app->user->identity->username;
            $model->created_at = date('Y-m-d H:i:s');
            $model->save(false);
            Yii::$app->session->setFlash('success', "Data saved!");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModelReferralNonMemberLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $namagabung="";
            $image1 = UploadedFile::getInstances($model, 'document_file');
            if(!empty($image1)){
                foreach ($image1 as $file) {
                    // $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileName = uniqid().$file->name;
                    $uploadDir = Yii::getAlias('@webroot/upload/referral/billing/');
                    if(!is_dir("upload/referral/billing/")) {
                        mkdir("upload/referral/billing/", 0777, true);
                    }                                           
                    $file->saveAs($uploadDir.'/'.$fileName);
                    $namagabung .= $fileName.";"; 	
                }
                $model->document_file = $model->getOldAttribute('document_file').$namagabung;
            }else{
                $model->document_file = $model->getOldAttribute('document_file');
            }
            if($_POST['ModelReferralNonMemberLog']['no_invoice'] != $model->getOldAttribute('no_invoice')){
            $model->invoicehistory = $model->invoicehistory.";".$model->no_invoice;
            }   
            $model->update_by = Yii::$app->user->identity->username;
            $model->update_at = date('Y-m-d H:i:s');
            $model->save(false);
            Yii::$app->session->setFlash('success', "Data Updated!");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $namagabung="";
            $image1 = UploadedFile::getInstances($model, 'gl_file');
            if(!empty($image1)){
                foreach ($image1 as $file) {
                    $fileName = uniqid().$file->name;
                    $uploadDir = Yii::getAlias('@webroot/upload/referral/so/');
                    if(!is_dir("upload/referral/so/")) {
                        mkdir("upload/referral/so", 0777, true);
                    }                                           
                    $file->saveAs($uploadDir.'/'.$fileName);
                    $namagabung .= $fileName.";"; 	
                }
                $model->gl_file = $model->getOldAttribute('gl_file').$namagabung;
            }else{
                $model->gl_file = $model->getOldAttribute('gl_file');
            }
            if(!empty($model->created_by_so)){
                if($_POST['ModelReferralNonMemberLog']['nomer_so'] != $model->getOldAttribute('nomer_so')){
                    $model->sohistory = $model->sohistory.";".$model->nomer_so;
                    }
                $model->update_by_so = Yii::$app->user->identity->username;
                $model->update_at_so = date('Y-m-d H:i:s');
                Yii::$app->session->setFlash('success', "Data Updated!");
                $model->save(false);
            }else{
                $model->created_by_so = Yii::$app->user->identity->username;
                $model->created_at_so = date('Y-m-d H:i:s');
                Yii::$app->session->setFlash('success', "Data saved!");
                $model->save(false);
            }
            if(isset($_POST['invoices'])){
                if($_POST['invoices'] == 'on'){
                    $datax = ModelReferralNonMemberLog::find()
                    ->where(['no_invoice' => $model->no_invoice])
                    ->orderBy('id')
                    ->all();
                    foreach ($datax as $key => $value) {
                        $model = $this->findModel($value['id']);
                        $model->nomer_so = Yii::$app->request->post()['ModelReferralNonMemberLog']['nomer_so'];
                        $model->nomer_pr = Yii::$app->request->post()['ModelReferralNonMemberLog']['nomer_pr'];
                        $model->tanggal_so_pr = Yii::$app->request->post()['ModelReferralNonMemberLog']['tanggal_so_pr'];
                        $model->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        }
        $datax = ModelReferralNonMemberLog::find()
        ->where(['no_invoice' => $model->no_invoice])
        ->orderBy('id')
        ->all();
        return $this->render('so', [
            'model' => $model,
            'data' =>$datax,
        ]);
    }

    public function actionAr($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->created_by_so)){
                $model->update_by_ar = Yii::$app->user->identity->username;
                $model->update_at_ar = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data updated!");

            }else{
                $model->created_by_ar = Yii::$app->user->identity->username;
                $model->created_at_ar = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data saved!");
            }
            $model->save(false);

            if(isset($_POST['nomer_so'])){
                if($_POST['nomer_so'] == 'on'){
                    $datax = ModelReferralNonMemberLog::find()
                    ->where(['nomer_so' => $model->nomer_so])
                    ->orderBy('id')
                    ->all();
                    foreach ($datax as $key => $value) {
                        $model = $this->findModel($value['id']);
                        $model->nomer_ar = Yii::$app->request->post()['ModelReferralNonMemberLog']['nomer_ar'];
                        $model->remarks_tim_ar = Yii::$app->request->post()['ModelReferralNonMemberLog']['remarks_tim_ar'];
                        $model->save(false);
                    }
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('ar', [
            'model' => $model,
        ]);
    }

    public function actionPo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->created_by_so)){
                $model->update_by_po = Yii::$app->user->identity->username;
                $model->update_at_po = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data Updated!");

            }else{
                $model->created_by_po = Yii::$app->user->identity->username;
                $model->created_at_po = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data saved!");

            }
            $model->save(false);

            if(isset($_POST['nomer_pr'])){
                if($_POST['nomer_pr'] == 'on'){
                    $datax = ModelReferralNonMemberLog::find()
                    ->where(['nomer_pr' => $model->nomer_pr])
                    ->orderBy('id')
                    ->all();
                    foreach ($datax as $key => $value) {
                        $model = $this->findModel($value['id']);
                        $model->nomer_po = Yii::$app->request->post()['ModelReferralNonMemberLog']['nomer_po'];
                        $model->remarks_tim_procurement = Yii::$app->request->post()['ModelReferralNonMemberLog']['remarks_tim_procurement'];
                        $model->save(false);
                    }
                }
            }


            return $this->redirect(['index']);
        }

        return $this->render('po', [
            'model' => $model,
        ]);
    }

    public function actionAp($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->created_by_so)){
                $model->update_by_ap = Yii::$app->user->identity->username;
                $model->update_at_ap = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data Updated!");

            }else{
                $model->created_by_ap = Yii::$app->user->identity->username;
                $model->created_at_ap = date('Y-m-d H:i:s');
            Yii::$app->session->setFlash('success', "Data saved!");

            }
            $model->save(false);

            if(isset($_POST['apinvoice'])){
                $datax = [];
                if($_POST['apinvoice'] == 'on'){
                    if(!empty($_POST['namaclient'])){
                        $datax = ModelReferralNonMemberLog::find()
                        ->where(['no_invoice' => $model->no_invoice])
                        ->andWhere(['client' => $_POST['namaclient']])
                        ->orderBy('id')
                        ->all();
                    }else{
                        $datax = ModelReferralNonMemberLog::find()
                        ->where(['no_invoice' => $model->no_invoice])
                        ->orderBy('id')
                        ->all();
                    }
                    foreach ($datax as $key => $value) {
                        $model = $this->findModel($value['id']);
                        $model->nomer_ap = Yii::$app->request->post()['ModelReferralNonMemberLog']['nomer_ap'];
                        $model->remark_tim_ap = Yii::$app->request->post()['ModelReferralNonMemberLog']['remark_tim_ap'];
                        $model->save(false);
                    }
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('ap', [
            'model' => $model,
        ]);
    }

    public function actionSoprpending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searchsoprpending(Yii::$app->request->queryParams);

        return $this->render('soprpending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArappending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searcharappending(Yii::$app->request->queryParams);

        return $this->render('arappending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArpending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searcharpending(Yii::$app->request->queryParams);

        return $this->render('arpending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPopending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searchpopending(Yii::$app->request->queryParams);

        return $this->render('popending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAppending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searchappending(Yii::$app->request->queryParams);

        return $this->render('appending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport(){
        if($_POST){ 
            $date1 = date("Y-m-d", strtotime($_POST['tgl1']));
            $date2 = date("Y-m-d", strtotime($_POST['tgl2']));
            $sql = "SELECT [tanggal_terima_berkas]
            ,[tanggal_periksa]
            ,[nama_rs]
            ,[no_invoice]
            ,[no_gl]
            ,[covteq]
            ,[nama_peserta]
            ,[jalur_pembuatan]
            ,[jumlah]
            ,[client]
            ,[link_dokumen_invoice]
            ,[tanggal_input_link_document]
            ,[tanggal_kirim_dokument_ar_ap]
            ,[remarks_tim_billing]
            ,[link_gl]
            ,[nomer_so]
            ,[nomer_pr]
            ,[tanggal_so_pr]
            ,[nomer_ar]
            ,[remarks_tim_ar]
            ,[nomer_po]
            ,[remarks_tim_procurement]
            ,[nomer_ap]
            ,[remark_tim_ap]
            ,[created_at]
            ,[created_by]
            ,[update_at]
            ,[update_by]
            ,[status_permasalahan]
            ,[created_at_so]
            ,[created_by_so]
            ,[update_at_so]
            ,[update_by_so]
            ,[created_at_ar]
            ,[created_by_ar]
            ,[update_at_ar]
            ,[update_by_ar]
            ,[created_at_po]
            ,[created_by_po]
            ,[update_at_po]
            ,[update_by_po]
            ,[created_at_ap]
            ,[created_by_ap]
            ,[update_at_ap]
            ,[update_by_ap]
            ,REPLACE(CONCAT('https://mpcore.medikaplaza.com/referral-non-member/download-reff-document?name=',[document_file]), ';', '  \\   ') as DocumentFile
             FROM REFERRAL_NON_MEMBER_LOG WHERE created_at BETWEEN '$date1 00:00:00' AND '$date2 23:59:59'";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            include Yii::getAlias('@webroot').'/inc/Export.php';
            ExportReportReferral($data);
        }else{
        return $this->render('reportreferal');
        } 
    }

    public function actionDownloadReffDocument($name)
    {
        ob_clean();
        $uploadDir = Yii::getAlias('@webroot/upload/referral/billing/');
        $completePath = Yii::getAlias($uploadDir.$name);
        return Yii::$app->response->sendFile($completePath)->send();
    }
    public function actionDownloadReffDocumentNewTab($name)
    {
        ob_clean();
        $uploadDir = Yii::getAlias('@webroot/upload/referral/billing/');
        $completePath = Yii::getAlias($uploadDir.$name);
        return Yii::$app->response->sendFile($completePath,$name, ['inline'=>true]);
    }

    public function actionDownloadReffSo($name)
    {
        ob_clean();
        $uploadDir = Yii::getAlias('@webroot/upload/referral/so/');
        $completePath = Yii::getAlias($uploadDir.$name);
        return Yii::$app->response->sendFile($completePath)->send();
    }

    public function actionDownloadReffSoNewTab($name)
    {
        ob_clean();
        $uploadDir = Yii::getAlias('@webroot/upload/referral/so/');
        $completePath = Yii::getAlias($uploadDir.$name);
        return Yii::$app->response->sendFile($completePath,$name, ['inline'=>true]);
    }

    public function actionTransmission($id,$code){
       $model = $this->findModel($id);

        $searchModel = new ReferralTransmissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('transmission', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDocumentpending()
    {
        $searchModel = new ModelReferralNonMemberLogSearch();
        $dataProvider = $searchModel->searchdocumentpending(Yii::$app->request->queryParams);

        return $this->render('documentpending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransmissionpending()
    {
        $searchModel = new ReferralTransmissionSearch();
        $dataProvider = $searchModel->searchpending(Yii::$app->request->queryParams);

        return $this->render('transmissionpending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Deletes an existing ModelReferralNonMemberLog model.
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

    /**
     * Finds the ModelReferralNonMemberLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModelReferralNonMemberLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModelReferralNonMemberLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
