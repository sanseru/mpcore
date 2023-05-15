<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
function ExportReport($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Test COvid")
    ->setSubject("TEst Covid")
    ->setDescription(
        "Ini adalah Hasil dari test covid"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Cocvid");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'No Invoice');
    $sheet->setCellValue('B1', 'Perusahaan');
    $sheet->setCellValue('C1', 'Status');
    $sheet->setCellValue('D1', 'Created By');
    $sheet->setCellValue('E1', 'Created Time');

    // Dari Database Datanya
    $database = \yii\helpers\ArrayHelper::toArray($model);
    $sheet->fromArray($database, null, 'A2');
    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);

    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}

function ExportReportWHopname($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Opname")
    ->setSubject("Opname")
    ->setDescription(
        "Ini adalah Hasil Opname"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Cocvid");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'Opname Code');
    $sheet->setCellValue('B1', 'Item No.');
    $sheet->setCellValue('C1', 'Item Description');
    $sheet->setCellValue('D1', 'In Stock');
    $sheet->setCellValue('E1', 'Qty Fisik');
    $sheet->setCellValue('F1', 'Selisih');
    $sheet->setCellValue('G1', 'Stock UoM');
    $sheet->setCellValue('H1', 'Expired Date');
    $sheet->setCellValue('I1', 'Created By');
    $sheet->setCellValue('J1', 'Created Time');
    $sheet->setCellValue('K1', 'No Registrasi Kesehatan');
    $sheet->setCellValue('L1', 'Kondisi');


    // Dari Database Datanya
    // $database = \yii\helpers\ArrayHelper::toArray($model);
    // $sheet->fromArray($database, null, 'A2');
    $i = 2;

    foreach($model as $row):
        $sheet->setCellValue('A'.$i, $row['code_head']);
        $sheet->setCellValue('B'.$i, $row['itemcode']);
        $sheet->setCellValue('C'.$i, $row['itemname']);
        $sheet->setCellValue('D'.$i, $row['stockInSAP']);	 
        $sheet->setCellValue('E'.$i, $row['stockReal']);
        $sheet->setCellValue('F'.$i, $row['selisih']);
        $sheet->setCellValue('G'.$i, $row['satuan']);	  
        $sheet->setCellValue('H'.$i, $row['expiredate']);	  
        $sheet->setCellValue('I'.$i, $row['createdBy']);	  
        $sheet->setCellValue('J'.$i, $row['createdTime']);	
        $sheet->setCellValueExplicit('K'.$i, $row['noregkesehatan'],PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('L'.$i, $row['kondisi']);
        $i++;
    endforeach;

    $spreadsheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);

    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Stock Opname '.$model[0]['code_head'].'.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}

function ExportReportWHopnameSUM($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Test COvid")
    ->setSubject("Opname")
    ->setDescription(
        "Ini adalah Hasil Opname"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Opname");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'Opname Code');
    $sheet->setCellValue('B1', 'Item No.');
    $sheet->setCellValue('C1', 'Item Description');
    $sheet->setCellValue('D1', 'In Stock');
    $sheet->setCellValue('E1', 'Qty Fisik');
    $sheet->setCellValue('F1', 'Selisih');
    $sheet->setCellValue('G1', 'Stock UoM');
    $sheet->setCellValue('H1', 'Expired Date');
    $sheet->setCellValue('I1', 'No Registrasi Kesehatan');
    $sheet->setCellValue('J1', 'Kondisi');

    $i = 2;
    foreach($model as $row):
        $id = $row['id_head'];
        $code = $row['code_head'];
        $itemcode = $row['itemcode'];
        $real = 0;
        $selisih = 0;
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode = '$itemcode' order by expiredate ASC ");
        $modelNB = $NB->queryAll();
        // $NByy = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode = '$itemcode' order by id DESC ");
        // $modelNByy = $NByy->queryAll();
        $NBzx = $connection->createCommand("
        SELECT T0.[ItemCode],T1.[ItemName], T0.[WhsCode], CONVERT(float,T0.[OnHand]) AS OnHand,T2.[UgpCode],
        T1.[InvntryUom]
        FROM [MP-8].KBM_LIVE.dbo.OITW T0 INNER JOIN [MP-8].KBM_LIVE.dbo.OITM T1 ON T0.[ItemCode] = T1.[ItemCode]
        INNER JOIN [MP-8].KBM_LIVE.dbo.OUGP T2 ON T1.[UgpEntry] = T2.[UgpEntry] WHERE T0.[WhsCode] = 'JKMP0001'
        AND T0.ItemCode ='$itemcode'");
        $datanyaxx = $NBzx->queryAll();

        $NBx = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode = '$itemcode' AND expiredate IS NOT NULL order by convert(datetime2, expiredate, 104) DESC ");
        $modelNBx = $NBx->queryAll();
        $terakhir =end($modelNBx);
        foreach($modelNB as $rowx):
            $real += $rowx['stockReal'];
        endforeach;
        $selisih = $datanyaxx[0]['OnHand'] - $real;
        $sheet->setCellValue('A'.$i, $row['code_head']);
        $sheet->setCellValue('B'.$i, $row['itemcode']);
        $sheet->setCellValue('C'.$i, $modelNB[0]['itemname']);
        $sheet->setCellValue('D'.$i, $datanyaxx[0]['OnHand']);	 
        $sheet->setCellValue('E'.$i, $real);
        $sheet->setCellValue('F'.$i, $selisih);
        $sheet->setCellValue('G'.$i, $modelNB[0]['satuan']);	  
        $sheet->setCellValue('H'.$i, $terakhir['expiredate']);
        $sheet->setCellValueExplicit('I'.$i, $modelNB[0]['noregkesehatan'],PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('J'.$i, $modelNB[0]['kondisi']);
        $i++;
    endforeach;

    $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);

    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Stock Opname '.$model[0]['code_head'].'.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}


function ExportReportWHalkes($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Test Alkes")
    ->setSubject("TEst Alkes")
    ->setDescription(
        "Ini adalah Hasil dari Alkes"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Alkes");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'Code Aset');
    $sheet->setCellValue('B1', 'No. Item');
    $sheet->setCellValue('C1', 'Nomer Inventory');
    $sheet->setCellValue('D1', 'Nama Alat');
    $sheet->setCellValue('E1', 'Merek');
    $sheet->setCellValue('F1', 'Model/Type');
    $sheet->setCellValue('G1', 'Serial Number');
    $sheet->setCellValue('H1', 'Lokasi');
    $sheet->setCellValue('I1', 'Tahun Pembelian');
    $sheet->setCellValue('J1', 'Kondisi Alat');
    $sheet->setCellValue('K1', 'Nomer Document Service Report');
    $sheet->setCellValue('L1', 'Action Plan');
    $sheet->setCellValue('M1', 'Status Barang');
    $sheet->setCellValue('N1', 'Nomer Inventory Transfer');
    $sheet->setCellValue('O1', 'Pengiriman');
    $sheet->setCellValue('P1', 'Penerimaan');
    $sheet->setCellValue('Q1', 'Tanggal Kalibrasi');
    $sheet->setCellValue('R1', 'Expire Date Kalibrasi');
    $sheet->setCellValue('S1', 'Sparepart');
    $sheet->setCellValue('T1', 'Kelengkapan Alat');



    // Dari Database Datanya
    $database = \yii\helpers\ArrayHelper::toArray($model);
    $sheet->fromArray($database, null, 'A2');
    $spreadsheet->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray);

    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}

function ExportReportReferral($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Test COvid")
    ->setSubject("TEst Covid")
    ->setDescription(
        "Ini adalah Hasil dari test covid"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Cocvid");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'Tanggal Terima Berkas');
    $sheet->setCellValue('B1', 'Tanggal Periksa');
    $sheet->setCellValue('C1', 'Nama RS');
    $sheet->setCellValue('D1', 'No Invoice');
    $sheet->setCellValue('E1', 'No Gl');
    $sheet->setCellValue('F1', 'Qovteq');
    $sheet->setCellValue('G1', 'Nama Peserta');
    $sheet->setCellValue('H1', 'Jalur Pembuatan');
    $sheet->setCellValue('I1', 'Jumlah');
    $sheet->setCellValue('J1', 'Nama Client');
    $sheet->setCellValue('K1', 'Link Dokument Invoice');
    $sheet->setCellValue('L1', 'Tanggal Input Link Dokument Invoice');
    $sheet->setCellValue('M1', 'Tanggal Kirim Dokument AP/AR');
    $sheet->setCellValue('N1', 'Remarks Team Billing');
    $sheet->setCellValue('O1', 'Link GL');
    $sheet->setCellValue('P1', 'Nomer SO');
    $sheet->setCellValue('Q1', 'Nomer PR');
    $sheet->setCellValue('R1', 'Tanggal SO PR');
    $sheet->setCellValue('S1', 'Nomer AR');
    $sheet->setCellValue('T1', 'Reamrks Team AR');
    $sheet->setCellValue('U1', 'Nomer PO');
    $sheet->setCellValue('V1', 'Remars Tim Procurement');
    $sheet->setCellValue('W1', 'Nomer AP');
    $sheet->setCellValue('X1', 'Remark Team AP');
    $sheet->setCellValue('Y1', 'Created At');
    $sheet->setCellValue('Z1', 'Created By');
    $sheet->setCellValue('AA1', 'Update At');
    $sheet->setCellValue('AB1', 'Update By');
    $sheet->setCellValue('AC1', 'Status');
    $sheet->setCellValue('AD1', 'Created At So');
    $sheet->setCellValue('AE1', 'Created By So');
    $sheet->setCellValue('AF1', 'Update At So');
    $sheet->setCellValue('AG1', 'Update By So');
    $sheet->setCellValue('AH1', 'Created At Ar');
    $sheet->setCellValue('AI1', 'Created By Ar');
    $sheet->setCellValue('AJ1', 'Update At Ar');
    $sheet->setCellValue('AK1', 'Update By Ar');
    $sheet->setCellValue('AL1', 'Created At Po');
    $sheet->setCellValue('AM1', 'Created By Po');
    $sheet->setCellValue('AN1', 'Update At Po');
    $sheet->setCellValue('AO1', 'Update By Po');
    $sheet->setCellValue('AP1', 'Created At Ap');
    $sheet->setCellValue('AQ1', 'Created By Ap');
    $sheet->setCellValue('AR1', 'Update At Ap');
    $sheet->setCellValue('AS1', 'Update By Ap');
    $sheet->setCellValue('AT1', 'Update By Ap');

    





    // Dari Database Datanya
    $database = \yii\helpers\ArrayHelper::toArray($model);
    $sheet->fromArray($database, null, 'A2');
    $spreadsheet->getActiveSheet()->getStyle('A1:AR1')->applyFromArray($styleArray);

    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}


function ExportKurir($model){
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()
    ->setCreator("Haris Lukman Hakim")
    ->setLastModifiedBy("Haris Lukman hakim")
    ->setTitle("Report Kurir")
    ->setSubject("Report Kurir")
    ->setDescription(
        "Ini adalah Hasil dari Report Kurir"
    )
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Hasil Cocvid");
    $sheet = $spreadsheet->getActiveSheet();

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];

    $sheet->setCellValue('A1', 'No Resi');
    $sheet->setCellValue('B1', 'Kurir');
    $sheet->setCellValue('C1', 'Perusahaan');
    $sheet->setCellValue('D1', 'Pengirim');
    $sheet->setCellValue('E1', 'Penerima');
    $sheet->setCellValue('F1', 'Manifested');
    $sheet->setCellValue('G1', 'On Process');
    $sheet->setCellValue('H1', 'Reschedule');
    $sheet->setCellValue('I1', 'Delivered');
    $sheet->setCellValue('J1', 'Canceled');
    $sheet->setCellValue('K1', 'Remarks');
    $sheet->setCellValue('L1', 'Status');
    $sheet->setCellValue('M1', 'Time Counter');
    $sheet->setCellValue('N1', 'Kurir');
    $sheet->setCellValue('O1', 'Resi Done/ Diterima Kembali');
    $sheet->setCellValue('P1', 'Resi Done/ Diterima Kembali Oleh');

    $i = 2;
    foreach($model as $row):
        $days = "";
        $banyak = "";
        if(!empty($row['onprocess_time']) && !empty($row['delivered_time'])){
            $date1 = new DateTime($row['onprocess_time']);
            $date2 = new DateTime($row['delivered_time']);
            $banyak  = $date1->diff($date2)->format('%a');
            $days  = $date1->diff($date2)->format('%R%a days');
        }

        $sheet->setCellValue('A'.$i, $row['codekirim']);
        $sheet->setCellValue('B'.$i, $row['delivered_by']);
        $sheet->setCellValue('C'.$i, $row['penerima']);
        $sheet->setCellValue('D'.$i, $row['pengirim']);	    
        $sheet->setCellValue('E'.$i, $row['namapic']);	    
        $sheet->setCellValue('F'.$i, $row['manifested']);	    
        $sheet->setCellValue('G'.$i, $row['onprocess_time']);	    
        $sheet->setCellValue('H'.$i, $row['reschedule_time']);	    
        $sheet->setCellValue('I'.$i, $row['delivered_time']);	    
        $sheet->setCellValue('J'.$i, $row['cancel_time']);	    
        $sheet->setCellValue('K'.$i, $row['catatan']);	    
        $sheet->setCellValue('L'.$i, $row['status'].$days);
        $sheet->setCellValue('M'.$i, $days);
        $sheet->setCellValue('N'.$i, $row['kurirnya']);
        $sheet->setCellValue('O'.$i, $row['resiback_time']);
        $sheet->setCellValue('P'.$i, $row['resiback']);



        if($banyak > 1 ){
            $spreadsheet
            ->getActiveSheet()
            ->getStyle('A'.$i.':P'.$i)
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FF0000');
        }
        
        $i++;


    endforeach;
    $writer = new Xlsx($spreadsheet);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="test.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer->save('php://output');
    die;
}




?>