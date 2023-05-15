<?php

use yii\helpers\Html;
use frontend\models\ModelInvTrackHead;
use frontend\models\ModelInvTrackDetail;
use Da\QrCode\QrCode;
use yii\helpers\Url;
use Hashids\Hashids;

    $path = Yii::getAlias('@webroot').'/plugin/fpdf182/fpdf.php';
    require $path;
    function printInv($inv){

   $bg = Yii::getAlias('@webroot').'/images/bg.png';
        $qrCode = (new QrCode(Url::base('https').'/inv-track-head/process-approve?id='.$inv))
        ->setSize(250)
        ->setMargin(5);


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT DocNum, DocCur,
        CONVERT(varchar, DocDate, 23)DocDate,
        CONVERT(varchar, DocDueDate, 23)DocDueDate,DocTotal,CardName 
        from [MP-8].KBM_LIVE.dbo.OINV  where DocNum ='".$inv."'");
            $model = $sql->queryAll();




        $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png'); // writer defaults to PNG when none is specified
        $pathqr = Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png';
        $pdf = new FPDF('P','mm','A4');// LEGAL 215.9,355.6 A4 210, 297

        $pdf->AliasNbPages();
    
        $pdf->AddPage();
        //$pdf->setAutoPageBreak(FALSE);
        $pdf->SetLeftMargin(10);
        $yi = 30; //posisi atas row ke dua
        $ya = 44; //posisi atas row paling atas
        $row=0;
        $pdf->Ln(5);
        $pdf->Image($bg, 0, 0, $pdf->w, $pdf->h);
        $pdf->Ln(40);

        $pdf->SetFont('Arial','',11);
        $pdf->cell(180,4,'Dear Managers ' . $model[0]['CardName'],0,1,'L',0);
        $pdf->Ln(1);
        $pdf->cell(180,4,'We hereby send an invoice with the following details:',0,1,'L',0);
        $pdf->Ln(10);

        $pdf->Cell(10,5,'No',1,0,'C',0);
        $pdf->Cell(45,5,'Invoice No.',1,0,'C',0);
        $pdf->Cell(45,5,'Posting Date',1,0,'C',0);
        $pdf->Cell(45,5,'Due Date',1,0,'C',0);
        $pdf->Cell(45,5,'Invoice Ammount',1,1,'C',0);

        $pdf->Cell(10,5,'1',1,0,'C',0);
        $pdf->Cell(45,5,$model[0]['DocNum'],1,0,'C',0);
        $pdf->Cell(45,5,date("d-m-Y", strtotime($model[0]['DocDate'])),1,0,'C',0);
        $pdf->Cell(45,5,date("d-m-Y", strtotime($model[0]['DocDueDate'])),1,0,'C',0);
        $pdf->Cell(45,5,(isset($model[0]['DocCur'])?$model[0]['DocCur'] :'').' '.number_format($model[0]['DocTotal']),1,0,'C',0);

        $pdf->Ln(30);
        $pdf->cell(180,4,'Shall be deemed as accepted unless advised in writing no longer than 7 calendar days from the invoice date.',0,1,'L',0);
        $pdf->Ln(2);
        $pdf->cell(180,4,'Please transfer the full payment according to the due date',0,1,'L',0);
        $pdf->Ln(30);
        $pdf->cell(180,4,'Thank You',0,1,'L',0);
        
        $pdf->SetXY( 55, 190);
        $pdf->cell(180,4,'Please Scan This Barcode For Transmittal Confirmation',0,1,'L',0);

        $pdf->Image($pathqr,85,200,30,0,'','', false);

        $pdf->Output();
        // exit;
    }


    function printqr($inv){



        $bg = Yii::getAlias('@webroot').'/images/bg.png';
             $qrCode = (new QrCode(Url::base(true).'/inv-track-head/process-approve?id='.$inv))
             ->setSize(250)
             ->setMargin(5);
     
     
             $connection = \Yii::$app->db;
             $sql = $connection->createCommand("SELECT DocNum, DocCur,
             CONVERT(varchar, DocDate, 23)DocDate,
             CONVERT(varchar, DocDueDate, 23)DocDueDate,DocTotal,CardName 
             from [MP-8].KBM_LIVE.dbo.OINV  where DocNum ='".$inv."'");
                 $model = $sql->queryAll();
     
             $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png'); // writer defaults to PNG when none is specified
             $pathqr = Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png';
             $pdf = new FPDF('P','mm',array(30,28));// LEGAL 215.9,355.6 A4 210, 297
     
             $pdf->AliasNbPages();
         
             $pdf->AddPage();
             $pdf->SetFont('Helvetica','B',4);
             $pdf->SetXY( 12, 1);
             $pdf->Cell(3,1,$model[0]['CardName'],0,0,'C',0);
             $pdf->Ln(2);
             $pdf->SetFont('Helvetica','',8);
             $pdf->Cell(9,1,$model[0]['DocNum'],0,0,'C',0);
             $pdf->Image($pathqr,3,5,22,0,'','', false);

             $pdf->Output();
             // exit;
            //  Settinga printer HIght 2,7 Width 2,7
         }


         function printSerah($model){
            $bg = Yii::getAlias('@webroot').'/images/bg.png';
            $pdf = new FPDF('P','mm','A4');// LEGAL 215.9,355.6 A4 210, 297
            $pdf->AliasNbPages();
            $pdf->AddPage();
            //$pdf->setAutoPageBreak(FALSE);
            $pdf->SetLeftMargin(10);
            $yi = 30; //posisi atas row ke dua
            $ya = 44; //posisi atas row paling atas
            $row=0;
            $pdf->Ln(5);
            $pdf->Image($bg, 0, 0, $pdf->w, $pdf->h);
            $pdf->Ln(25);
            $pdf->SetFont('Arial','',16);
            $pdf->cell(190,8,'BERITA ACARA',0,1,'C',0);
            $pdf->cell(190,8,'SERAH TERIMA ASSET PERUSAHAAN',0,1,'C',0);
            $pdf->Ln(5);
            $pdf->SetFont('Arial','',9);
            $pdf->cell(40,4,'NAMA PENERIMA',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,$model->User_Name,0,1,'L',0);

            $pdf->cell(40,4,'HARI',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,date('l', strtotime($model->Date_Asset)),0,1,'L',0);

            $pdf->cell(40,4,'TANGGAL',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,date('d-m-Y', strtotime($model->Date_Asset)),0,1,'L',0);

            $pdf->cell(40,4,'STATUS ASSET',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,$model->Status_Aset,0,1,'L',0);

            $pdf->cell(40,4,'PROJECT',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,$model->Project,0,1,'L',0);

            $pdf->cell(40,4,'LOCATION',0,0,'L',0);
            $pdf->cell(10,4,':',0,0,'C',0);
            $pdf->cell(140,4,$model->Location,0,1,'L',0);
            $pdf->Ln(5);
            $pdf->SetFont('Arial','',10);
            $pdf->cell(190,6,'Telah diberikan asset perusahaan, adapun asset yang diberikan berupa (the assets are given to companies in the form of) :',0,0,'L',0);
            $pdf->Ln(7);

            $pdf->SetFont('Arial','',8);
            $pdf->setFillColor(230,230,230);   
            $pdf->Cell(10,4,'No',1,0,'C',true);
            $pdf->Cell(80,4,'DESKRIPSI BARANG',1,0,'C',true);
            $pdf->Cell(60,4,'NOMOR ASSET',1,0,'C',true);
            $pdf->Cell(40,4,'KONDISI',1,1,'C',true);

            $pdf->Cell(10,4,'1',1,0,'C',0);
            $pdf->Cell(80,4,$model->Manufacturer.' '.$model->Vesion_Product . ' ('.$model->Services_Tag.')',1,0,'C',0);
            $pdf->Cell(60,4,$model->Host_Name,1,0,'C',0);
            $pdf->Cell(40,4,$model->Status_Aset,1,1,'C',0);

            $myArray = explode('|', $model->Addon_Item);
            $no = 2;
            foreach($myArray as $my_Array){
                $myArray2 = explode(';', $my_Array);
                $pdf->Cell(10,4,$no,1,0,'C',0);
                $pdf->Cell(80,4,$myArray2[0],1,0,'C',0);
                $pdf->Cell(60,4,$myArray2[1],1,0,'C',0);
                $pdf->Cell(40,4,$myArray2[2],1,1,'C',0);
                $no++;
            }



            $pdf->SetXY( 10, 132);
            $pdf->Cell(64,4,'DISERAHKAN OLEH;',1,0,'C',true);
            $pdf->Cell(64,4,'DITERIMA OLEH;',1,0,'C',true);
            $pdf->Cell(63,4,'MENGETAHUI;',1,1,'C',true);
            $pdf->Cell(64,20,'Sign : ',1,0,'L',0);
            $pdf->Cell(64,20,'Sign',1,0,'L',0);
            $pdf->Cell(63,20,'Sign',1,1,'L',0);
            $pdf->Cell(64,5,'Nama: : ',1,0,'L',0);
            $pdf->Cell(64,5,'Nama:',1,0,'L',0);
            $pdf->Cell(63,5,'Nama:',1,1,'L',0);
            $pdf->Cell(64,5,'Dept : ',1,0,'L',0);
            $pdf->Cell(64,5,'Dept',1,0,'L',0);
            $pdf->Cell(63,5,'Dept',1,1,'L',0);
            

            $pdf->SetXY( 10, 170);
            $pdf->SetFont('Arial','',10);
            $pdf->Ln(5);
            $pdf->MultiCell(190,6,'Telah dikembalikan asset perusahaan, adapun asset yang dikembalikan berupa (the assets are returned to companies in the form of) :',0,'L',0);
            $pdf->SetFont('Arial','',8);
            $pdf->Ln(5);

            $pdf->Cell(10,7,'No',1,0,'C',true);
            $pdf->Cell(80,7,'DESKRIPSI BARANG',1,0,'C',true);
            $pdf->Cell(60,7,'NOMOR ASSET',1,0,'C',true);
            $pdf->Cell(40,7,'KONDISI',1,1,'C',true);

            $pdf->Cell(10,4,'1',1,0,'C',0);
            $pdf->Cell(80,4,$model->Manufacturer.' '.$model->Vesion_Product . ' ('.$model->Services_Tag.')',1,0,'C',0);
            $pdf->Cell(60,4,$model->Host_Name,1,0,'C',0);
            $pdf->Cell(40,4,$model->Status_Aset,1,1,'C',0);

            $myArray = explode('|', $model->Addon_Item);
            $no = 2;
            foreach($myArray as $my_Array){
                $myArray2 = explode(';', $my_Array);
                $pdf->Cell(10,4,$no,1,0,'C',0);
                $pdf->Cell(80,4,$myArray2[0],1,0,'C',0);
                $pdf->Cell(60,4,$myArray2[1],1,0,'C',0);
                $pdf->Cell(40,4,$myArray2[2],1,1,'C',0);
                $no++;
            }

            $pdf->SetXY( 10, 225);
            $pdf->Cell(64,4,'DISERAHKAN OLEH;',1,0,'C',true);
            $pdf->Cell(64,4,'DITERIMA OLEH;',1,0,'C',true);
            $pdf->Cell(63,4,'MENGETAHUI;',1,1,'C',true);
            $pdf->Cell(64,20,'Sign : ',1,0,'L',0);
            $pdf->Cell(64,20,'Sign',1,0,'L',0);
            $pdf->Cell(63,20,'Sign',1,1,'L',0);
            $pdf->Cell(64,5,'Nama: : ',1,0,'L',0);
            $pdf->Cell(64,5,'Nama:',1,0,'L',0);
            $pdf->Cell(63,5,'Nama:',1,1,'L',0);
            $pdf->Cell(64,5,'Dept : ',1,0,'L',0);
            $pdf->Cell(64,5,'Dept',1,0,'L',0);
            $pdf->Cell(63,5,'Dept',1,1,'L',0);
            $pdf->Ln(4);

            $pdf->SetFont('Courier','',8);
            $pdf->Cell(63,3,'No Formulir : FM-IT-014-02',0,1,'L',0);
            $pdf->Cell(63,3,'Revisi : 00',0,1,'L',0);
            $pdf->Cell(63,3,'Tgl Terbit : 7 Januari 2019',0,1,'L',0);


            $pdf->Output();
                 // exit;
             }


        function printqrwh($inv){



        $bg = Yii::getAlias('@webroot').'/images/bg.png';
                $qrCode = (new QrCode($inv))
                ->setSize(250)
                ->setMargin(5);
        
        
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM V_ItemCode  where ItemCode ='".$inv."'");
                    $model = $sql->queryAll();
        
        
        
        
                $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png'); // writer defaults to PNG when none is specified
                $pathqr = Yii::getAlias('@webroot') . '/images/qrcode/'.$inv.'.png';
                $pdf = new FPDF('P','mm',array(30,28));// LEGAL 215.9,355.6 A4 210, 297
        
                $pdf->AliasNbPages();
            
                $pdf->AddPage();
                $pdf->SetFont('Helvetica','B',4);
                $pdf->SetXY( 12, 1);
                $pdf->Cell(3,1,$model[0]['ItemName'],0,0,'C',0);
                $pdf->Ln(2);
                $pdf->SetFont('Helvetica','',8);
                $pdf->Cell(9,1,$model[0]['ItemCode'],0,0,'C',0);
                $pdf->Image($pathqr,3,5,22,0,'','', false);

                $pdf->Output();
                // exit;
            //  Settinga printer HIght 2,7 Width 2,7
            }

        function printqralkes($id,$code){



             $bg = Yii::getAlias('@webroot').'/images/bg.png';
                $qrCode = (new QrCode($code))
                ->setSize(1000)
                ->setMargin(5);
        
        
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES  where codeAset ='".$code."'");
                    $model = $sql->queryAll();
    
        
                $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcodealkes/'.$code.'.png'); // writer defaults to PNG when none is specified
                $pathqr = Yii::getAlias('@webroot') . '/images/qrcodealkes/'.$code.'.png';
                $pdf = new FPDF('P','mm',array(30,28));// LEGAL 215.9,355.6 A4 210, 297
        
                $pdf->AliasNbPages();

                $pdf->AddPage();
                $pdf->SetFont('Helvetica','',5.5);
                $pdf->SetMargins(0,0);
                $pdf->SetXY(0,0.5);
                $pdf->Cell(26,1,'PT Kartika Bina Medikatama',0,0,'C',0);
                $pdf->SetXY(0.5,2.5);
                $pdf->Cell(27,4,'Code '.$code,0,1,'C',0);
                $pdf->Image($pathqr,5,7,18,18,'PNG','', false);


                $pdf->AddPage('L',array(50,50));
                $pdf->SetAutoPageBreak(false,0);

                $pdf->SetFont('Helvetica','B',10);
                // $pdf->SetXY(0.5,1);
                $pdf->Ln(2);
                $pdf->Cell(13,1,$code,0,1,'L',0);
                $pdf->Ln(2);
                $pdf->MultiCell(50,3,substr($model[0]['namaAlat'], 0, 2000),0,'L',0);
                $pdf->Ln(3);
                $pdf->MultiCell(50,3,'SAP: '.$model[0]['noAsset_SAP'],0,'L',0);
                $pdf->Ln(2);
                $pdf->MultiCell(50,3,'Merek: '.$model[0]['merk'],0,'L',0);
                $pdf->Ln(2);
                // $pdf->MultiCell(50,3,'No Inv: '.$model[0]['noInventory'],0,'L',0);
                // $pdf->Ln(2);
                $pdf->MultiCell(50,3,'Tipe:'.$model[0]['tipe'],0,'L',0);
                $pdf->Ln(2);
                $pdf->MultiCell(50,3,'Seri:'.$model[0]['noSeri'],0,'L',0);
                
                $pdf->Output();
                // exit;
            //  Settinga printer HIght 2,7 Width 2,7
        }

        function printpengiriman($id){
            $hashids = new Hashids('apixan',30);
            $hash = $hashids->encode($id);
            $bg = Yii::getAlias('@webroot').'/images/bg.png';
            $logo = Yii::getAlias('@webroot').'/images/logompbw.png';

            $qrCode = (new QrCode($hash))
            ->setSize(250)
            ->setMargin(5);

            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT * FROM KURIR_HEAD  where id =$id");
            $model = $sql->queryAll();
            
            $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcode/'.$hash.'.png'); // writer defaults to PNG when none is specified
            $pathqr = Yii::getAlias('@webroot') . '/images/qrcode/'.$hash.'.png';
            $pdf = new FPDF('P','mm','A4');// LEGAL 215.9,355.6 A4 210, 297

            $pdf->AliasNbPages();

            $pdf->AddPage();
            //$pdf->setAutoPageBreak(FALSE);
            $pdf->SetLeftMargin(10);
            $pdf->Ln(5);
            // $pdf->Image($bg, 0, 0, $pdf->w, $pdf->h);
            $pdf->Image($logo,10,6,40,0,'','', false);
            $pdf->Ln(10);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(190,4,"Resi Pengiriman",0,1,'C',0);
            $pdf->Ln(1);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(190,4,"No Resi : ".strtoupper($model[0]['codekirim']),0,1,'R',0);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Ln(5);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(50,4,"PENGIRIM",0,1,'L',0);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Ln(5);
            $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
            $pdf->Cell(50,4,$model[0]['pengirim'],0,1,'L',0);
            $pdf->Ln(2);
            $pdf->SetFont('Helvetica','',8);
            $pdf->Cell(16,4,"Alamat",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            if(Yii::$app->user->identity->role != 20){
                $pdf->MultiCell(90,4,"Beltway Office Park - Tower C ,Jl. TB Simatupang, RT.1/RW.1, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12540",0,'L',0);

            }else{
                $pdf->MultiCell(90,4,"WTC 2 CLINIC WORD TRADE CENTER 2 , LOWER GROUND FLOOR, JL JEND SUDIRMAN KAV 29 JAKARTA SELATAN 12920 Phone : 02129522611",0,'L',0);
            }
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Telepon",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->Cell(19,4,$model[0]['nopengirim'],0,1,'L',0);


            $pdf->Ln(10);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(50,4,"PENERIMA",0,1,'L',0);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Ln(5);
            $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
            $pdf->Cell(50,4,strtoupper($model[0]['namapic'])." - ".$model[0]['penerima'],0,1,'L',0);
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Alamat",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->SetFont('Helvetica','',8);
            $pdf->MultiCell(90,4,$model[0]['alamat'],0,'L',0);
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Catatan",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->MultiCell(170,4,$model[0]['catatan'],0,'L',0);
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Telepon",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->Cell(19,4,$model[0]['nopenerima'],0,1,'L',0);
            $pdf->Image($pathqr,150,40,40,0,'','', false);


            $pdf->Ln(5);
            $pdf->Cell(190,4,"=================================================Silahkan di Pisahkan=================================================",0,1,'L',0);
            $pdf->Ln(14);
            $y = $pdf->GetY();
            $pdf->Image($logo,10,$y-14,40,0,'','', false);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(190,4,"Resi Pengiriman",0,1,'C',0);
            $pdf->Ln(1);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(190,4,"No Resi : ".strtoupper($model[0]['codekirim']),0,1,'R',0);
            $pdf->Ln(5);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(50,4,"PENGIRIM",0,1,'L',0);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Ln(5);
            $pdf->Cell(20,4,"Pengirim :",0,0,'L',0);
            $pdf->Cell(50,4,$model[0]['pengirim'],0,1,'L',0);
            $pdf->Ln(2);
            $pdf->SetFont('Helvetica','',8);
            $pdf->Cell(16,4,"Alamat",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            if(Yii::$app->user->identity->role != 20){
                $pdf->MultiCell(90,4,"Beltway Office Park - Tower C ,Jl. TB Simatupang, RT.1/RW.1, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12540",0,'L',0);

            }else{
                $pdf->MultiCell(90,4,"WTC 2 CLINIC WORD TRADE CENTER 2 , LOWER GROUND FLOOR, JL JEND SUDIRMAN KAV 29 JAKARTA SELATAN 12920 Phone : 02129522611",0,'L',0);
            }
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Telepon",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->Cell(19,4,$model[0]['nopengirim'],0,1,'L',0);
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',20);
            $pdf->Cell(50,4,"PENERIMA",0,1,'L',0);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Ln(5);
            $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
            $pdf->Cell(50,4,strtoupper($model[0]['namapic'])." - ".$model[0]['penerima'],0,1,'L',0);
            $pdf->Ln(2);
            $pdf->SetFont('Helvetica','',8);
            $pdf->Cell(16,4,"Alamat",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->MultiCell(90,4,$model[0]['alamat'],0,'L',0);
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Catatan",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->MultiCell(170,4,$model[0]['catatan'],0,'L',0);
            $pdf->Ln(2);
            $pdf->Cell(16,4,"Telepon",0,0,'L',0);
            $pdf->Cell(4,4,":",0,0,'L',0);
            $pdf->Cell(19,4,$model[0]['nopenerima'],0,1,'L',0);

            // $pdf->Image($pathqr,150,195,30,0,'','', false);
            $pdf->Cell(190,4,"(Tanda Tangan Penerima)",0,1,'R',0);
            $pdf->Output();
            exit();
             }


             function printpengirimanloop($items){
                $ids = join("','",$items);   
                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT * FROM KURIR_HEAD  where id in ('$ids')");
                $model = $sql->queryAll();

                $pdf = new FPDF('P','mm','A4');// LEGAL 215.9,355.6 A4 210, 297
        
                $pdf->AliasNbPages();

                foreach ($model as $key => $value) {
                    $hashids = new Hashids('apixan',30);
                    $hash = $hashids->encode($value['id']);
                    $logo = Yii::getAlias('@webroot').'/images/logompbw.png';
        
                    $qrCode = (new QrCode($hash))
                    ->setSize(250)
                    ->setMargin(5);
                    
                    $qrCode->writeFile(Yii::getAlias('@webroot') . '/images/qrcode/'.$hash.'.png'); // writer defaults to PNG when none is specified
                    $pathqr = Yii::getAlias('@webroot') . '/images/qrcode/'.$hash.'.png';
       
                    $pdf->AddPage();
                    //$pdf->setAutoPageBreak(FALSE);
                    $pdf->SetLeftMargin(10);
                    $pdf->Ln(5);
                    // $pdf->Image($bg, 0, 0, $pdf->w, $pdf->h);
                    $pdf->Image($logo,10,6,40,0,'','', false);
                    $pdf->Ln(10);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(190,4,"Resi Pengiriman",0,1,'C',0);
                    $pdf->Ln(1);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Cell(190,4,"No Resi : ".strtoupper($value['codekirim']),0,1,'R',0);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Ln(5);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(50,4,"PENGIRIM",0,1,'L',0);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Ln(5);
                    $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
                    $pdf->Cell(50,4,$value['pengirim'],0,1,'L',0);
                    $pdf->Ln(2);
                    $pdf->SetFont('Helvetica','',8);
                    $pdf->Cell(16,4,"Alamat",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->MultiCell(90,4,"Beltway Office Park - Tower C ,Jl. TB Simatupang, RT.1/RW.1, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12540",0,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Telepon",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->Cell(19,4,$value['nopengirim'],0,1,'L',0);
        
        
                    $pdf->Ln(10);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(50,4,"PENERIMA",0,1,'L',0);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Ln(5);
                    $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
                    $pdf->Cell(50,4,strtoupper($value['namapic'])." - ".$value['penerima'],0,1,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Alamat",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->SetFont('Helvetica','',8);
                    $pdf->MultiCell(90,4,$value['alamat'],0,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Catatan",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->MultiCell(170,4,$value['catatan'],0,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Telepon",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->Cell(19,4,$value['nopenerima'],0,1,'L',0);
                    $pdf->Image($pathqr,150,40,40,0,'','', false);
        
        
                    $pdf->Ln(5);
                    $pdf->Cell(190,4,"=================================================Silahkan di Pisahkan=================================================",0,1,'L',0);
                    $pdf->Ln(14);
                    $y = $pdf->GetY();
                    $pdf->Image($logo,10,$y-14,40,0,'','', false);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(190,4,"Resi Pengiriman",0,1,'C',0);
                    $pdf->Ln(1);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Cell(190,4,"No Resi : ".strtoupper($value['codekirim']),0,1,'R',0);
                    $pdf->Ln(5);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(50,4,"PENGIRIM",0,1,'L',0);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Ln(5);
                    $pdf->Cell(20,4,"Pengirim :",0,0,'L',0);
                    $pdf->Cell(50,4,$value['pengirim'],0,1,'L',0);
                    $pdf->Ln(2);
                    $pdf->SetFont('Helvetica','',8);
                    $pdf->Cell(16,4,"Alamat",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    if(Yii::$app->user->identity->role != 3){
                        $pdf->MultiCell(90,4,"Beltway Office Park - Tower C ,Jl. TB Simatupang, RT.1/RW.1, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12540",0,'L',0);

                    }else{
                        $pdf->MultiCell(90,4,"WTC 2 CLINIC WORD TRADE CENTER 2 , LOWER GROUND FLOOR, JL JEND SUDIRMAN KAV 29 JAKARTA SELATAN 12920 Phone : 02129522611",0,'L',0);
                    }
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Telepon",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->Cell(19,4,$value['nopengirim'],0,1,'L',0);
                    $pdf->Ln(8);
                    $pdf->SetFont('Helvetica','',20);
                    $pdf->Cell(50,4,"PENERIMA",0,1,'L',0);
                    $pdf->SetFont('Helvetica','',10);
                    $pdf->Ln(5);
                    $pdf->Cell(20,4,"Penerima :",0,0,'L',0);
                    $pdf->Cell(50,4,strtoupper($value['namapic'])." - ".$value['penerima'],0,1,'L',0);
                    $pdf->Ln(2);
                    $pdf->SetFont('Helvetica','',8);
                    $pdf->Cell(16,4,"Alamat",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->MultiCell(90,4,$value['alamat'],0,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Catatan",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->MultiCell(170,4,$value['catatan'],0,'L',0);
                    $pdf->Ln(2);
                    $pdf->Cell(16,4,"Telepon",0,0,'L',0);
                    $pdf->Cell(4,4,":",0,0,'L',0);
                    $pdf->Cell(19,4,$value['nopenerima'],0,1,'L',0);
        
                    // $pdf->Image($pathqr,150,195,30,0,'','', false);
                    $pdf->Cell(190,4,"(Tanda Tangan Penerima)",0,1,'R',0);
                }
                $uniqid = uniqid();
                $attachDir = Yii::getAlias('@webroot/upload/pdfuploadkurir/'.str_replace('/','',$uniqid));
                if(!is_dir("upload/pdfuploadkurir/". str_replace('/','',$uniqid) ."/")) {
                    mkdir("upload/pdfuploadkurir/". str_replace('/','',$uniqid) ."/");
                }                
                $filename="".$attachDir."/".str_replace('/','',$uniqid).".pdf";
                $pdf->Output($filename,'F');
                return $uniqid;
            }






?>