<?php

namespace frontend\controllers;

use frontend\models\ModelKurirHead;
use frontend\models\ModelKurirStatus;
use frontend\models\ModelKurirDetail;
use frontend\models\ModelUser;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Hashids\Hashids;
use yii\helpers\Html;
use yii\web\UploadedFile;


class KurirController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCetak($id)
    {
        include Yii::getAlias('@webroot') . '/inc/pdf.php';
        printpengiriman($id);
    }

    public function actionAdmin()
    {
        $status = ModelKurirStatus::find()->all();
        $users = ModelUser::find()->all();

        return $this->render('admin', [
            'status' => $status,
            'users' => $users
        ]);
    }

    public function actionFinance()
    {
        $status = ModelKurirStatus::find()->all();
        $users = ModelUser::find()->all();

        return $this->render('finance', [
            'status' => $status,
            'users' => $users
        ]);
    }


    public function actionKurirview()
    {
        $status = ModelKurirStatus::find()->all();
        $users = ModelUser::find()->all();

        return $this->render('kurirview', [
            'status' => $status,
            'users' => $users
        ]);
    }
    public function actionScanbarcode()
    {
        $status = ModelKurirStatus::find()->all();
        $users = ModelUser::find()->all();
        return $this->render('scanbarcode', [
            'status' => $status,
            'users' => $users
        ]);
    }

    public function actionDownloadimport()
    {
        // $path = Yii::getAlias('@webroot').'/document/download/Template Upload Member.csv';   
        $path = Yii::getAlias('@webroot') . '/inc/template/Import Pengiriman Barang.xlsx';
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }

    public function actionUploadexcell()
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if ($_FILES) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($_FILES['fileexcel']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $items = array();
            foreach (array_slice($sheetData, 1) as $key => $models) :
                $input = new ModelKurirHead();
                $chars = "abcdefghijkmnopqrstuvwxyz023456789";
                srand((float)microtime() * 1000000);
                $i = 0;
                $pass = '';

                while ($i <= 7) {
                    $num = rand() % 33;
                    $tmp = substr($chars, $num, 1);
                    $pass = $pass . $tmp;
                    $i++;
                }
                $input->codekirim = $pass;
                $input->penerima = $models[0];
                $input->nopenerima = $models[2];
                $input->namabarang = $models[3];
                $input->alamat = $models[4];
                $input->pengirim = Yii::$app->user->identity->username;
                $input->nopengirim = $models[6];
                $input->namapic = $models[1];
                $input->catatan = $models[5];
                $input->status = 1;
                $input->created_at = date('Y-m-d H:i:s');
                $input->created_by = Yii::$app->user->identity->username;
                $input->save(false);
                $items[] = $input->getPrimaryKey();
            endforeach;
            include Yii::getAlias('@webroot') . '/inc/pdf.php';
            $uniqidfile = printpengirimanloop($items);
            $data = [
                'data' => 'success',
                'filenya' => $uniqidfile
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }

    public function actionDownloadupload()
    {
        $name = $_GET['data'];
        $path = Yii::getAlias('@webroot') . '/upload/pdfuploadkurir/' . $name . '/' . $name . '.pdf';
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];
        $this->findModel($id)->delete();
        $data = [
            'data' => 'success',
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionExportkurir()
    {
        $date1 = date("Y-m-d", strtotime($_POST['dari']));
        $date2 = date("Y-m-d", strtotime($_POST['sampai']));
        $sql = "SELECT *
         FROM v_kurir_export WHERE manifested BETWEEN '$date1 00:00:00' AND '$date2 23:59:59'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        include Yii::getAlias('@webroot') . '/inc/Export.php';
        ExportKurir($data);
    }

    protected function findModel($id)
    {
        if (($model = ModelKurirHead::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFinancePengiriman()
    {
        $hashids = new Hashids('12131213', 10);

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'ItemCode',
            1 => 'ItemName',
        );



        $sql = "SELECT KURIR_HEAD.*,KURIR_STATUS.status opstatus FROM KURIR_HEAD 
        JOIN KURIR_STATUS ON KURIR_STATUS.id = KURIR_HEAD.STATUS
        LEFT JOIN [user] ON [user].username = KURIR_HEAD.pengirim WHERE [user].department = 3 ";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        $totalData = count($data);
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            $sql .= " AND ( KURIR_HEAD.codekirim like '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR KURIR_HEAD.pengirim LIKE '%" . $requestData['search']['value'] . "%'";
            $sql .= " OR KURIR_HEAD.namabarang LIKE '%" . $requestData['search']['value'] . "%'";
            $sql .= " OR KURIR_HEAD.penerima LIKE '%" . $requestData['search']['value'] . "%')";
        }

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);

        $sql .= " ORDER BY id DESC  OFFSET " . $requestData['start'] . "  " . " ROWS 
        FETCH NEXT " . $requestData['length'] .  " ROWS ONLY";

        $result = Yii::$app->db->createCommand($sql)->queryAll();


        $data = array();


        foreach ($result as $key => $row) {


            $url = Url::to(['kurir/cetak', 'id' => $row['id']]);
            $idx = $row['id'];
            // $view = "<button type=\"button\" title='Edit Data' id='tracker' onClick=\"getdataedit($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-default\">
            // <span class=\"fas fa-pen\"></span>
            // </button>";
            $delivery = "<button type=\"button\" title='Tracking Data' onClick=\"gettracking($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-lg\">
            <span class=\"fas fa-truck\"></span>
            </button>";
            $cetak2 = Html::a('<span class="fas fa-qrcode"></span>', $url, ['title' => Yii::t('app', 'Print'), 'class' => 'btn btn-xs', 'target' => '_blank']);

            if ($row["opstatus"] == "Manifested ( Mendaftarkan )") {
                $color = "warning";
            } elseif ($row["opstatus"] == "Cancel ( Di Batalkan )") {
                $color = "danger";
            } elseif ($row["opstatus"] == "Delivered ( Terkirim )") {
                $color = "success";
            } else {
                $color = "info";
            }
            $nestedData = array();
            $nestedData[] = $row["codekirim"] . "</br>Kurir:" . $row["kurirnya"];
            $nestedData[] = $row["pengirim"];
            $nestedData[] = $row["penerima"];
            $nestedData[] = $row["namapic"];
            $nestedData[] = $row["namabarang"];
            $nestedData[] = $row["catatan"];
            $nestedData[] = $row["alamat"];
            $nestedData[] = "<small class=\"badge badge-" . $color . "\">" . $row["opstatus"] . "</small>";
            $nestedData[] = date("d-m-Y", strtotime($row["created_at"]));
            $nestedData[] = $cetak2 . $delivery;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data   // total data array
        );

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $json_data;
    }
    public function actionInsertkurir()
    {
        // $hashids = new Hashids('apixan',30);
        if ($_POST) {
            $model = ModelKurirHead::findOne(['id' => $_POST['idx']]);
            $model->status = $_POST['status'];
            if ($_POST['status'] == 2) {
                $model->onprocess_by = Yii::$app->user->identity->username;
                $model->kurirnya = Yii::$app->user->identity->username;
                $model->onprocess_time = date('Y-m-d H:i:s');
            } elseif ($_POST['status'] == 3) {
                $model->reschedule_by = Yii::$app->user->identity->username;
                $model->kurirnya = Yii::$app->user->identity->username;
                $model->reschedule_time = date('Y-m-d H:i:s');
            } elseif ($_POST['status'] == 4) {
                # code...
                $model->delivered_by = Yii::$app->user->identity->username;
                $model->kurirnya = Yii::$app->user->identity->username;
                $model->delivered_time = date('Y-m-d H:i:s');
                $codekirim = strtoupper($model->codekirim);
                $text = "{\"message\":\"Paket *$codekirim*  [$model->penerima] berhasil dilakukan pengiriman oleh *$model->kurirnya* pada jam $model->delivered_time \\n *Remarks :* \\n $model->catatan \\n _Sent Auto by System, Not By Haris_  \"}";
               $this->Kirimwa($text);
            } elseif ($_POST['status'] == 5) {
                # code...
                $model->kurirnya = Yii::$app->user->identity->username;
                $model->cancel_by = Yii::$app->user->identity->username;
                $model->delivered_by = Yii::$app->user->identity->username;
                $model->cancel_time = date('Y-m-d H:i:s');
                $model->cancelRemarks = $_POST['catatancancel'];
            }
            $model->save(false);
            $detail = new ModelKurirDetail();
            $detail->head_id = $_POST['idx'];
            $detail->status = $_POST['status'];
            $detail->username = Yii::$app->user->identity->username;
            $detail->remarks = $_POST['remarks'] . $_POST['catatancancel'];
            // $detail->photo = $_POST['idx'];
            $photo = UploadedFile::getInstanceByName('photo');
            if (isset($photo)) {
                $fileName = uniqid() . $photo->name;
                $uploadDir = Yii::getAlias('@webroot/upload/kurir/');
                if (!is_dir("upload/kurir/")) {
                    mkdir("upload/kurir/");
                }
                $photo->saveAs($uploadDir . '/' . $fileName);
                $detail->photo = $fileName;
            }
            $detail->createdby = Yii::$app->user->identity->username;
            $detail->createdtime = date('Y-m-d H:i:s');
            $detail->save(false);
            $data = [
                'data' => 'success',
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }

    public function Kirimwa($text)
    {

        $curl = curl_init();
        // CURLOPT_URL => 'http://192.168.1.89:8767/group/sendmessage/MP%20Courier%20n%20Finance%20n%20MR',

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.1.92:8780/group/sendmessage/Expedisi%20Messenger%20MP',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $text,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
