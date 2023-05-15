<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ModelInvTrackHead;
use frontend\models\ModelInvTrackHeadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ModelInvTrackDetail;
use yii\filters\AccessControl;

/**
 * InvTrackHeadController implements the CRUD actions for ModelInvTrackHead model.
 */
class InvTrackHeadController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
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
                        'actions' => ['process-approve'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ModelInvTrackHead models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new ModelInvTrackHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModelInvTrackHead model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $mdoel = $this->findModel($id);
        $detail = ModelInvTrackDetail::find()->where(['no_invoice'=>$mdoel->noinvoice])->orderBy([
            'id' => SORT_DESC    
            ])->All();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'detail' => $detail
        ]);
    }

    /**
     * Creates a new ModelInvTrackHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new ModelInvTrackHead();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->identity->username;
            $model->created_time = date('Y-m-d H:i:s');
            $model->status = 1;
            $model->save(false);

            $detail = new ModelInvTrackDetail();
            $detail->no_invoice = $model->noinvoice;
            $detail->status = 1;
            $detail->name = Yii::$app->user->identity->username;;
            $detail->description = 'Create Invoice Tracker';
            $detail->createdTime = date('Y-m-d H:i:s');
            $detail->createdBy = Yii::$app->user->identity->username;
            $detail->save(false);
            Yii::$app->session->setFlash('success', "Data saved!");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModelInvTrackHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);
            Yii::$app->session->setFlash('success', "Data Updated!");

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModelInvTrackHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $head = $this->findModel($id);
        $detail = ModelInvTrackDetail::find()->where(['no_invoice'=>$head->noinvoice])->All();
        foreach($detail as $details){$details->delete();}
        $head->delete();
        Yii::$app->session->setFlash('danger', "Data Deleted!");

        return $this->redirect(['index']);
    }
    public function actionPrint($id){
        include Yii::getAlias('@webroot').'/inc/pdf.php';
        printInv($id);

    }
    public function actionProcessApprove($id){
        $this->enableCsrfValidation = false; 
        $model = ModelInvTrackHead::findOne(['noinvoice' => $id]);
        if($model->status < 4){
            if(isset($_POST['nama'])){
                $model = ModelInvTrackHead::findOne(['noinvoice' => $id]);
                // $sql = "SELECT DocNum invoice,CardName perusahaan FROM [MP-8].KBM_LIVE.dbo.OINV WHERE DocNum = '$models[0]'";
                $middle = strtotime($model->created_time);             // returns bool(false)
                $new_date = date('Y-m-d', $middle);   // returns 1970-01-01 00:00:00
                $new_date1= $new_date.' 00:00:00';
                $new_date2= $new_date.' 23:00:00';

                $sql = "SELECT * FROM INV_TRACK_HEAD where perusahaan = '$model->perusahaan' and created_time 
                        between   '$new_date1' and ' $new_date2'";
                $data = Yii::$app->db->createCommand($sql)->queryAll();
                $sqlxx = "SELECT CardCode FROM [MP-8].KBM_LIVE.dbo.OINV WHERE DocNum = '$id'";
                $dataxx = Yii::$app->db->createCommand($sqlxx)->queryAll();
                $middle = strtotime($new_date);             // returns bool(false)
                $batchnya2 = $dataxx[0]['CardCode'].$middle;
                $clientnya = $dataxx[0]['CardCode'];
                    foreach($data as $models):
                                $model = ModelInvTrackHead::findOne(['noinvoice' => $models['noinvoice']]);
                                $status = $models['status'];
                                $model->status = $status+1;
                                $model->batching = $batchnya2;
                                $model->save(false);
                                $detail = new ModelInvTrackDetail();
                                if (!empty($_FILES)) {
                                    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
                                    // Buat Base 64
                                    // $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                                    // $data = file_get_contents($file_tmp);
                                    // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    // Buat base 64
                                    $nama = mt_rand(1000,9000);
                                    move_uploaded_file($file_tmp,Yii::getAlias('@frontend/web/images/img/').$_FILES['fileToUpload']['name']);
                                    $detail->photo = $_FILES['fileToUpload']['name'];
                                    // tinggal tambahin buat save data base64
                                }
                                $detail->no_invoice = $models['noinvoice'];
                                $invce = $models['noinvoice'];
                                $detail->status =$model->status;
                                $detail->name = $_POST['nama'];
                                $detail->description = $_POST['keterangan'];
                                $detail->createdTime = date('Y-m-d H:i:s');
                                $detail->createdBy =$_POST['nama'];
                                $detail->save(false);
                                if($detail->status == 2 ){
                                    $akandi = 'Akan dilakukan pengiriman';
                                }else{
                                    $akandi = 'Telah Diterima';
                                }
                                $namanya = $_POST['nama'];
                                $kontent = '<!doctype html>
                                <html>
                                  <head>
                                    <meta name="viewport" content="width=device-width">
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                    <title>Email Notifikasi Pengiriman Invoice</title>
                                    <style>
                                    /* -------------------------------------
                                        INLINED WITH htmlemail.io/inline
                                    ------------------------------------- */
                                    /* -------------------------------------
                                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                                    ------------------------------------- */
                                    @media only screen and (max-width: 620px) {
                                      table[class=body] h1 {
                                        font-size: 28px !important;
                                        margin-bottom: 10px !important;
                                      }
                                      table[class=body] p,
                                            table[class=body] ul,
                                            table[class=body] ol,
                                            table[class=body] td,
                                            table[class=body] span,
                                            table[class=body] a {
                                        font-size: 16px !important;
                                      }
                                      table[class=body] .wrapper,
                                            table[class=body] .article {
                                        padding: 10px !important;
                                      }
                                      table[class=body] .content {
                                        padding: 0 !important;
                                      }
                                      table[class=body] .container {
                                        padding: 0 !important;
                                        width: 100% !important;
                                      }
                                      table[class=body] .main {
                                        border-left-width: 0 !important;
                                        border-radius: 0 !important;
                                        border-right-width: 0 !important;
                                      }
                                      table[class=body] .btn table {
                                        width: 100% !important;
                                      }
                                      table[class=body] .btn a {
                                        width: 100% !important;
                                      }
                                      table[class=body] .img-responsive {
                                        height: auto !important;
                                        max-width: 100% !important;
                                        width: auto !important;
                                      }
                                    }
                                
                                    /* -------------------------------------
                                        PRESERVE THESE STYLES IN THE HEAD
                                    ------------------------------------- */
                                    @media all {
                                      .ExternalClass {
                                        width: 100%;
                                      }
                                      .ExternalClass,
                                            .ExternalClass p,
                                            .ExternalClass span,
                                            .ExternalClass font,
                                            .ExternalClass td,
                                            .ExternalClass div {
                                        line-height: 100%;
                                      }
                                      .apple-link a {
                                        color: inherit !important;
                                        font-family: inherit !important;
                                        font-size: inherit !important;
                                        font-weight: inherit !important;
                                        line-height: inherit !important;
                                        text-decoration: none !important;
                                      }
                                      #MessageViewBody a {
                                        color: inherit;
                                        text-decoration: none;
                                        font-size: inherit;
                                        font-family: inherit;
                                        font-weight: inherit;
                                        line-height: inherit;
                                      }
                                      .btn-primary table td:hover {
                                        background-color: #34495e !important;
                                      }
                                      .btn-primary a:hover {
                                        background-color: #34495e !important;
                                        border-color: #34495e !important;
                                      }
                                    }
                                    </style>
                                  </head>
                                  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Informasi Pengiriman Invoice Oleh Medikaplaza</span>
                                    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
                                      <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                                        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                                          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                                
                                            <!-- START CENTERED WHITE CONTAINER -->
                                            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">
                                
                                              <!-- START MAIN CONTENT AREA -->
                                              <tr>
                                                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                                    <tr>
                                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi User,</p>
                                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Kami Menginformasikan bahwa Invoice '.$models['noinvoice']. ' '. $akandi.' Oleh '. $namanya.' berkas invoice dari Medikaplaza</p>
                                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">The email is sent by the system automatically. Please do not reply. Thank you!</p>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                </td>
                                              </tr>
                                
                                            <!-- END MAIN CONTENT AREA -->
                                            </table>
                                
                                            <!-- START FOOTER -->
                                            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                                              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                                <tr>
                                                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">BELTWAY OFFICE PARK,
                                TOWER C, 2nd Floor,
                                Jl. TB. Simatupang Kav. 41
                                Jakarta Selatan 12550</span>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                                    Powered by <a href="http://htmlemail.io" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">ICT Medikaplaza</a>.
                                                  </td>
                                                </tr>
                                              </table>
                                            </div>
                                            <!-- END FOOTER -->
                                
                                          <!-- END CENTERED WHITE CONTAINER -->
                                          </div>
                                        </td>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                                      </tr>
                                    </table>
                                  </body>
                                </html>';
                                // $emails = "SELECT E_MailL FROM [MP-8].KBM_LIVE.dbo.OCPR where CardCode = '$clientnya' and CardCode NOT IN ('C09BA01546')";
                                // $email = Yii::$app->db->createCommand($emails)->queryAll();
                                $kirim = 'Mahendra.Rani@medikaplaza.com;';
                                // $jumlah = count($email);
                                // if($jumlah > 0){
                                //     foreach($email as $emails):
                                //         $kirim .= $emails['E_MailL'].';';
                                //     endforeach;
                                // }else{
                                //     $kirim = 'Mahendra.Rani@medikaplaza.com;';
                                // }
                                $kirim = substr($kirim,0,255);
                                $email = Yii::$app->db->createCommand("INSERT INTO mail.dbo.MailSend(
                                    [From]
                                ,[To]
                                ,[Cc]
                                ,[Bcc]
                                ,[ReplyTo]
                                ,[Subject]
                                ,[Content]
                                ,[Source]
                                ,[Link]
                                )VALUES(
                                'noreply@medikaplaza.com'
                                ,'$kirim'
                                ,'mp.notifikasi.in@gmail.com;haris.lukman@medikaplaza.com;Bambang.Prihadi@medikaplaza.com;'
                                ,' '
                                ,'noreply@medikaplaza.com'
                                ,'INVOICE TRACKING'
                                ,'$kontent'
                                ,'INVOICE TRACKING'
                                ,' '
                            )")->execute();
                    endforeach;   

                return  $this->renderPartial('terimakasih');
            }
                return $this->renderPartial('approved'); 
      }else{
        return  $this->renderPartial('sudahditerima');

      }

    }
    public function actionUploadinvoice(){
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            
            // ngambil model filenya haha
            $model = new ModelInvTrackHead();
        if ($model->load(Yii::$app->request->post())){

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            // var_dump($_FILES['TmpPendaftaran']['tmp_name']['file']);die;
            $spreadsheet = $reader->load($_FILES['ModelInvTrackHead']['tmp_name']['file']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            foreach($sheetData as $models):
                $model = new ModelInvTrackHead();
                $sql = "SELECT DocNum invoice,CardName perusahaan FROM [MP-8].KBM_LIVE.dbo.OINV WHERE DocNum = '$models[0]'";
                $data = Yii::$app->db->createCommand($sql)->queryAll();
                $model->noinvoice = $models[0];
                $model->perusahaan = $data[0]['perusahaan'];
                $model->created_by = Yii::$app->user->identity->username;
                $model->created_time = date('Y-m-d H:i:s');
                $model->status = 1;
                $model->save(false);
    
                $detail = new ModelInvTrackDetail();
                $detail->no_invoice = $model->noinvoice;
                $detail->status = 1;
                $detail->name = Yii::$app->user->identity->username;;
                $detail->description = 'Create Invoice Tracker';
                $detail->createdTime = date('Y-m-d H:i:s');
                $detail->createdBy = Yii::$app->user->identity->username;
                $detail->save(false);
            endforeach;   
        return $this->redirect(['index']);

        }
        return $this->render('uploadinv', [
            'model' => $model,

        ]);

    }
    public function actionReport(){
        if($_POST){ 
            $date1 = date("Y-m-d", strtotime($_POST['tgl1']));
            $date2 = date("Y-m-d", strtotime($_POST['tgl2']));
            $sql = "SELECT* FROM V_Export WHERE created_time BETWEEN '$date1 00:00:00' AND '$date2 23:59:59'";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            include Yii::getAlias('@webroot').'/inc/Export.php';
            ExportReport($data);
        }else{
        return $this->render('reportinv');
        } 
    }
    public function actionDownload(){
        // $path = Yii::getAlias('@webroot').'/document/download/Template Upload Member.csv';   
        $path = Yii::getAlias('@webroot').'/inc/template/Invoice.xlsx';   
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }
    public function actionPrintqr($id){
        include Yii::getAlias('@webroot').'/inc/pdf.php';
        printqr($id);    
    }
    public function actionBatchingview(){

      return $this->render('batchview', []);
    }
    /**
     * Finds the ModelInvTrackHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ModelInvTrackHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = ModelInvTrackHead::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
