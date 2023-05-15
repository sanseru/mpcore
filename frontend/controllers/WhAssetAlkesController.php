<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ModeWhAssetAlkes;
use frontend\models\ModeWhAssetAlkesSearch;
use frontend\models\ModelWhAssetAlkesAcessories;
use frontend\models\ModelWhAssetAlkesRepair;
use frontend\models\ModelWhAssetAlkesCalibration;
use frontend\models\ModelWhAssetAlkesTracking;
use frontend\models\ModeWhAssetAlkesMaintenance;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;


/**
 * WhAssetAlkesController implements the CRUD actions for ModeWhAssetAlkes model.
 */
class WhAssetAlkesController extends Controller
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
     * Lists all ModeWhAssetAlkes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModeWhAssetAlkesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $connection = \Yii::$app->db;
        $calibration = $connection->createCommand(";with cteRowNumber as (select codeAsset,institusi,tgl_endkalibrasi,
        row_number() over(partition by codeAsset order by tgl_endkalibrasi desc) as RowNum
        from WH_ASSET_ALKES_CALIBRATION)
        select a.codeAsset,a.institusi,a.tgl_endkalibrasi, b.namaAlat, b.lokasi
          from cteRowNumber a
          JOIN WH_ASSET_ALKES b ON b.codeAset = a.codeAsset
          where a.RowNum = 1 AND a.tgl_endkalibrasi BETWEEN GETDATE() AND DATEADD(DAY,+30,GETDATE())   
        ");
        $datacalibration = $calibration->queryAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'calibration' => $datacalibration,
        ]);
    }

    /**
     * Displays a single ModeWhAssetAlkes model.
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
     * Creates a new ModeWhAssetAlkes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModeWhAssetAlkes();

        if ($model->load(Yii::$app->request->post())) {

            $modelCode = ModeWhAssetAlkes::find()->orderBy(['id' => SORT_DESC])->one();
            $codex = (isset($modelCode->codeAset) ? substr($modelCode->codeAset, 8, 1000) : 0) + 1;
            $model->codeAset = 'MP-ASET-' . $codex;
            $model->createdBy = Yii::$app->user->identity->username;
            $model->createdTime = date('Y-m-d H:i:s');
            $image1 = UploadedFile::getInstance($model, 'pic1');
            if (isset($image1->tempName)) {
                $fileName = uniqid() . $image1->name;
                $uploadDir = Yii::getAlias('@webroot/upload/alkeswh/image/');
                if (!is_dir("upload/alkeswh/image/")) {
                    mkdir("upload/alkeswh/image/");
                }
                $image1->saveAs($uploadDir . '/' . $fileName);
                $model->pic1 = $fileName;
            }
            $image2 = UploadedFile::getInstance($model, 'pic2');
            if (isset($image2->tempName)) {
                $fileName = uniqid() . $image2->name;
                $uploadDir = Yii::getAlias('@webroot/upload/alkeswh/image/');
                if (!is_dir("upload/alkeswh/image/")) {
                    mkdir("upload/alkeswh/image/");
                }
                $image2->saveAs($uploadDir . '/' . $fileName);
                $model->pic2 = $fileName;
            }

            $model->save(false);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ModeWhAssetAlkes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


            $model->modifiedBy = Yii::$app->user->identity->username;
            $model->modifiedTime = date('Y-m-d H:i:s');
            $image1 = UploadedFile::getInstance($model, 'pic1');
            if (isset($image1->tempName)) {
                $fileName = uniqid() . $image1->name;
                $uploadDir = Yii::getAlias('@webroot/upload/alkeswh/image/');
                if (!is_dir("upload/alkeswh/image/")) {
                    mkdir("upload/alkeswh/image/");
                }
                $image1->saveAs($uploadDir . '/' . $fileName);
                $model->pic1 = $fileName;
            }
            $image2 = UploadedFile::getInstance($model, 'pic2');
            if (isset($image2->tempName)) {
                $fileName = uniqid() . $image2->name;
                $uploadDir = Yii::getAlias('@webroot/upload/alkeswh/image/');
                if (!is_dir("upload/alkeswh/image/")) {
                    mkdir("upload/alkeswh/image/");
                }
                $image2->saveAs($uploadDir . '/' . $fileName);
                $model->pic2 = $fileName;
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionQrcodeprint($id, $code)
    {
        include Yii::getAlias('@webroot') . '/inc/pdf.php';
        printqralkes($id, $code);
    }


    public function actionExportdata()
    {
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT 
        [codeAset]
              ,a.noAsset_SAP
              ,a.noInventory
              ,a.namaAlat
              ,a.merk
              ,a.tipe
              ,a.noSeri
              ,a.lokasi
              ,a.tglBeli
              ,a.kondisi
              ,(SELECT TOP 1 nosr FROM  WH_ASSET_ALKES_MAINTENANCE WHERE codeAsset = a.codeAset ORDER BY id DESC ) Nodocument
              ,(SELECT TOP 1 actionplan FROM  WH_ASSET_ALKES_MAINTENANCE WHERE codeAsset = a.codeAset ORDER BY id DESC) action_plan
              ,(SELECT TOP 1 StatusBarang FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) StatusBarang
              ,(SELECT TOP 1 noInvTrans FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) noInvTrans
              ,(SELECT TOP 1 tgl_pengiriman FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_pengiriman
              ,(SELECT TOP 1 tgl_penerimaan FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_penerimaan
              ,(SELECT TOP 1 tgl_kalibrasi FROM  WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_kalibrasi
              ,(SELECT TOP 1 tgl_endkalibrasi FROM  WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_endkalibrasi
              ,(SELECT TOP 1 sparepart FROM  WH_ASSET_ALKES_REPAIR WHERE codeAsset = a.codeAset ORDER BY id DESC) sparepart
              ,(SELECT Stuff((SELECT N', ' + CAST(acessories AS varchar(4000)) FROM WH_ASSET_ALKES_ACESSORIES WHERE codeAsset = a.codeAset FOR XML PATH(''),TYPE).value('text()[1]','nvarchar(max)'),1,2,N'')) acessories
        FROM WH_ASSET_ALKES a");
        $modelNB = $NB->queryAll();
        include Yii::getAlias('@webroot') . '/inc/Export.php';
        ExportReportWHalkes($modelNB);
    }


    public function actionIndexUser()
    {
        $searchModel = new ModeWhAssetAlkesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexuser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewUser($id)
    {
        return $this->render('viewuser', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionScanBarcodeAlkes()
    {
        return $this->render('scanbarcode', []);
    }

    public function actionUpload()
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $model = new ModeWhAssetAlkes();
        if ($model->load(Yii::$app->request->post())) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadsheet = $reader->load($_FILES['ModeWhAssetAlkes']['tmp_name']['pic1']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                foreach (array_slice($sheetData, 1) as $key => $model) :
                    $alkes = new ModeWhAssetAlkes();
                    // $drawing = $worksheet->getDrawingCollection()[$key];
                    // if ($drawing->getPath()) {
                    //     // Check if the source is a URL or a file path
                    //     $zipReader = fopen($drawing->getPath(), 'r');
                    //     $imageContents = '';
                    //     while (!feof($zipReader)) {
                    //         $imageContents .= fread($zipReader, 1024);
                    //     }
                    //     fclose($zipReader);
                    //     $extension = $drawing->getExtension();
                    // }
                    // $myFileName = uniqid() . '.' . $extension;
                    // $uploadDir = Yii::getAlias('@webroot/upload/alkeswh/image/');
                    // file_put_contents($uploadDir.$myFileName, $imageContents);
                    // var_dump($models);die;
                    $modelCode = ModeWhAssetAlkes::find()->orderBy(['id' => SORT_DESC])->one();
                    $codex = (isset($modelCode->codeAset) ? substr($modelCode->codeAset, 8, 1000) : 0) + 1;
                    $alkes->codeAset = 'MP-ASET-' . $codex;
                    $alkes->noAsset_SAP = $model[0];
                    $alkes->namaAlat = $model[1];
                    $alkes->merk = $model[2];
                    $alkes->tipe = $model[3];
                    $alkes->noSeri = $model[4];
                    $alkes->lokasi = $model[5];
                    $alkes->tglBeli = $model[6];
                    $alkes->tglKalibrasi = $model[7];
                    $alkes->tglexpKalibrasi = $model[8];
                    $alkes->Supplier = $model[9];
                    $alkes->kondisi = $model[10];
                    $alkes->createdBy = Yii::$app->user->identity->username;
                    $alkes->createdTime = date('Y-m-d H:i:s');
                    $alkes->save(false);
                    if (!empty($model[11]) || $model[11] != "") {
                        $split = explode(";", $model[11]);
                        foreach ($split as $key => $value) {
                            $aksesoris = new ModelWhAssetAlkesAcessories();
                            $aksesoris->codeAsset = 'MP-ASET-' . $codex;
                            $aksesoris->acessories = $value;
                            $aksesoris->createdBy = Yii::$app->user->identity->username;
                            $aksesoris->createdTime = date('Y-m-d H:i:s');
                            $aksesoris->save(false);
                        }
                    }

                endforeach;
                $transaction->commit();
                Yii::$app->session->setFlash('success', "Data Inserted!");
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('uploadalkes', [
            'model' => $model,

        ]);
    }

    public function actionDownload()
    {
        // $path = Yii::getAlias('@webroot').'/document/download/Template Upload Member.csv';   
        $path = Yii::getAlias('@webroot') . '/inc/template/Alkes Upload.xlsx';
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }
    /**
     * Deletes an existing ModeWhAssetAlkes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $model = ModeWhAssetAlkes::findOne($id);
            $this->findModel($id)->delete();
            $data1 = ModelWhAssetAlkesAcessories::findOne(['codeAsset' => $model->codeAset]);
            if(!empty($data1)){
                $data1->delete();
            }
            $data2 = ModelWhAssetAlkesRepair::findOne(['codeAsset' => $model->codeAset]);
            if(!empty($data2)){
                $data2->delete();
                
            }
            $data3 = ModelWhAssetAlkesCalibration::findOne(['codeAsset' => $model->codeAset]);
            if(!empty($data3)){
                $data3->delete();
                
            }
            $data4 = ModelWhAssetAlkesTracking::findOne(['codeAsset' => $model->codeAset]);
            if(!empty($data4)){
                $data4->delete();
                
            }
            $data5 = ModeWhAssetAlkesMaintenance::findOne(['codeAsset' => $model->codeAset]);
            if(!empty($data5)){
                $data5->delete();
            }
            $transaction->commit();
            Yii::$app->session->setFlash('success', "Data Deleted Berhasil!");
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Finds the ModeWhAssetAlkes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModeWhAssetAlkes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModeWhAssetAlkes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
