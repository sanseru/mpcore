<?php

namespace frontend\controllers;
use Yii;
use yii\filters\AccessControl;
use frontend\models\ModelMasRebate;


class RebateController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
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

    public function actionIndex()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time', '0'); // for infinite time of execution 

        if($_POST){
            // var_dump($_FILES);die;
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($_FILES['fileToUpload']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $jumlah = 0;
            $provider='';
            $bytes = random_bytes(5);
            $codex=bin2hex($bytes);
            foreach($sheetData as $k=>$models):
                if ($k < 1) continue;
                $input = new ModelMasRebate();
                $input->batchNumber = $models[0];
                $input->claimNumber = $models[1];
                $input->InvoiceNumber = $models[2];
                $input->receiveDate = $models[3];
                $input->admissionDate = $models[4];
                $input->dischargeDate = $models[5];
                $input->member = $models[6];
                $input->cardNumber = $models[7];
                $input->employeeName = $models[8];
                $input->relasi = $models[9];
                $input->idCustomer = $models[10];
                $input->department = $models[11];
                $input->providerName = $models[12];
                $input->bank = $models[13];
                $input->cabang = $models[14];
                $input->rekening = $models[15];
                $input->atasNama = $models[16];
                $input->email = $models[17];
                $input->dx = $models[18];
                $input->dxDescription = $models[19];
                $input->dx2 = $models[20];
                $input->dx2Description = $models[21]; 
                $input->dx3 = $models[22];
                $input->dx3Description = $models[23]; 
                $input->type = $models[24];
                $input->services = $models[25];
                $input->remarks = $models[26];
                $input->status = $models[27];
                $input->charge = $models[28];
                $input->approved = $models[29];
                $input->bayarDimuka = $models[30];
                $input->excess = $models[31];
                $input->userMas = $models[32];
                $input->dueDate = $models[33];
                $input->perusahaan = $models[34];
                $input->gender = $models[35];
                $input->birthday = $models[36];
                $input->jobPosition = $models[37];
                $input->dateCheked = $models[38];
                $input->dateApproved = $models[39];
                $input->datePaid = $models[40];
                $input->codeUpload = $codex;
                $input->createdBy = Yii::$app->user->identity->username;
                $input->createdTime = date('Y-m-d H:i:s');
                $input->save(false);
            endforeach;   
        }
        return $this->render('index');
    }

    public function actionCountrebate(){

        return $this->render('rebate');
    }

    public function actionDetailupload(){

        return $this->render('viewupload');
    }

}
