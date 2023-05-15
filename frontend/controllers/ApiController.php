<?php

namespace frontend\controllers;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use Hashids\Hashids;
use yii\web\UploadedFile;
use frontend\models\ModelRole;
use frontend\models\ModelMenu;
use frontend\models\ModelSubmenu;
use frontend\models\ModelMenuakses;
use frontend\models\ModelInvTrackHead;
use frontend\models\ModelInvTrackDetail;
use frontend\models\ModelKurirDetail;
use frontend\models\ModelSerahterimaasset;
use frontend\models\ModelWarehouseStockOPDetail;
use frontend\models\ModeWhAssetAlkesMaintenance;
use frontend\models\ModeWhAssetAlkes;
use frontend\models\ModelWhAssetAlkesTracking;
use frontend\models\ModelWhAssetAlkesCalibration;
use frontend\models\ModelWhAssetAlkesRepair;
use frontend\models\ModelWhAssetAlkesAcessories;
use frontend\models\ModelMasRebate;
use frontend\models\ModelKurirHead;
use frontend\models\ModelReferralNonMemberLog;
use yii\helpers\VarDumper;
use yii\filters\AccessControl;

class ApiController extends \yii\web\Controller
{

    public static function allowedDomains(){
		return [
			'*',				
		];
    }
    
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
		return array_merge(parent::behaviors(), [
			'corsFilter'  => [
				'class' => \yii\filters\Cors::className(),
				'cors'  => [					
					'Origin'                           => static::allowedDomains(),					
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age'           => 3600,    
				],
			],

		]);
    }


    public function actionListMenu(){
        
        $output = array();         
        if($_POST){

            $arrData = $_POST['data'];
            $arrData = explode(";", $arrData);
            $model = ModelMenu::find()
                    ->where(['flag'=>1])
                    ->all();
            
            $html = '';
           
            $html .='<div id="fontSizeWrapper">
                        <label for="fontSize">Tree Menu</label>                
                    </div>
                    <ul class="tree list-inline">';
            $x = 0;
            $d = 0;
            foreach($model as $models):
                $x += 1;
                
                $privileges = ModelMenuakses::find()
                    ->where(['like', 'menu_name', $models->nama_menu])
                    ->AndWhere(['description'=>'HEAD'])
                    ->AndWhere(['idrole'=>$arrData[0]])
                    ->One();
    
                if($privileges){
                    $checks = $privileges->flag == 1 ? 'checked':'';
                }else{
                    $checks = '';
                }
              

                $detail = ModelSubmenu::find()
                    ->where(['parent_id'=>$models->idmenu])
                    ->andWhere(['flag'=>1])
                    ->all();
                    $child = '';
                    foreach($detail as $details):
                        
                        $privilege = ModelMenuakses::find()
                                    ->where(['like', 'menu_name', $details->nama_menu])
                                    ->AndWhere(['description'=>'CHILD'])
                                    ->AndWhere(['idrole'=>$arrData[0]])
                                    ->One();
                      
                        if(isset($privilege->flag)){
                            $check = $privilege->flag == 1 ? 'checked':'';
                        }else{
                            $check = '';
                        }
                        $d += 1;
                        $child .=' <li class=" list-inline">
                                        <input type="checkbox"  '.$check.' name="detail" id="d'.$d.'" />
                                        <label for="d'.$d.'" class="tree_label">'.$details->nama_menu.'</label>                                 
                                    </li>';
                    endforeach;
                $html .='
                            <li>
                                <input type="checkbox" '.$checks.' name="check" id="c'.$x.'" />
                                <label class="tree_label" for="c'.$x.'">'.$models->nama_menu.'</label>
                                <ul>
                                   '.$child.'
                                   
                                </ul>
                            </li>
                            
                       ';
            endforeach;
            $html .=' </ul>';
            return $html;
        }else{
            var_dump($output);die;

            $data = json_encode($output);
            $data = [
                'data'=>'Method Not Allowed'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
		    return $data;
        }
        
		
		
    }
    public function actionDivision(){
        $model = ModelRole::find()
                ->all();
        
        $output = array();        

        foreach($model as $i => $models):
            $output[$i] = array(
                          $models->role_name,                                              
                          '<i data-id='.$models->idrole.';'.$models->role_name.' class="fas fa-plus add"></i>'
            );


        endforeach;
                
        $data = json_encode($output);
        $data = [
            'data'=>$output
        ];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;

    }
    public function actionPostPrivilege(){
        if($_POST){
            
            $head = explode(',',$_POST['master']);
            $childMenu = explode(',',$_POST['child']);

            $model = ModelMenu::find()
                    ->where(['flag'=>1])
                    ->OrderBy(['idmenu'=>SORT_ASC])
                    ->all();

            

            $del= ModelMenuakses::find()
                ->where(['idrole'=>$_POST['role']])
                ->all();
                
                
            if(isset($del)){
                foreach($del as $dels){
                    $dels->delete();
                }
            }
            $x = 0;
            foreach($model as $i => $models):
                         
                $privilege = new ModelMenuakses();
                $privilege->idrole = $_POST['role'];
                $privilege->description = 'HEAD';
                $privilege->menu_name = $models->nama_menu;
                $privilege->flag = $head[$i];
                $privilege->save();
                            // echo $i;
                            $child = ModelSubmenu::find()
                                ->where(['flag'=>1])
                                ->AndWhere(['parent_id'=>$models->idmenu])
                                ->OrderBy(['idchild'=>SORT_ASC])
                                ->all();

                            foreach($child as $key => $childs):
                                $x++;
                                $privilege = new ModelMenuakses();
                                $privilege->idrole = $_POST['role'];
                                $privilege->description = 'CHILD';
                                $privilege->menu_name = $childs->nama_menu;
                                $privilege->flag = $childMenu[$x-1];
                                $privilege->save();
                            endforeach;
                            // // var_dump($head[$i]);
            endforeach;
            $data = [
                'data'=>'success'
            ];
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{
            $output = array();
            $data = json_encode($output);
            $data = [
                'data'=>'Method Not Allowed'
            ];
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    public function actionGetInvoice(){ 

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'DocNum',
                1 => 'CardName',
             );
        
       $sql = "SELECT DocNum invoice,CardName perusahaan FROM [MP-8].KBM_LIVE.dbo.OINV WHERE 1=1";
       

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
     
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( DocNum LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql.=" OR CardName LIKE '" . $requestData['search']['value'] . "%')";
            // $sql.=" OR province LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR city LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR postal_code LIKE '" . $requestData['search']['value'] . "%')";          
        }
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
       
        $data = array();
        $i=1;
        
        foreach ($result as $key => $row)
        {
            $nestedData = array();
            $nestedData[] = $row["invoice"];
            $nestedData[] = $row["perusahaan"];
            $nestedData[] = "<center><i class=\"addinvoice fas fa-plus\" aria-hidden=\"true\" data-id=\"".$row['invoice'].';'.$row['perusahaan']."\"></i></center>";
            $data[] = $nestedData;            
            $i++;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), 
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
        
    }
    public function actionInvoicePreview(){
        $option = '';
        if($_POST){
            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT DocNum, 
            CONVERT(varchar, DocDate, 23)DocDate,
            CONVERT(varchar, DocDueDate, 23)DocDueDate,DocTotal 
            from [MP-8].KBM_LIVE.dbo.OINV  where DocNum ='".$_POST['invoice']."'");
        $model = $sql->queryAll();


        $option .= '<div class="row">
        <div class="col-sm-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!--<th>Customer Name</th>-->
                        <th width="20">No</th>
                        <th>No.Invoice</th>
                        <th>Posting Date</th>
                        <th>Due Date</th>
                        <th style="text-align: right;">Balance Due</th>
                    </tr>
                </thead>
                <tbody>';
                    $no = 1;
                    foreach ($model as $field_key) {
                        $option .="<tr>
                            <td style='padding: 1px;'>". $no ."</td>
                            <td style='padding: 1px;'>". $field_key['DocNum'] ."</td>
                            <td style='padding: 1px;'>". $field_key['DocDate'] ."</td>
                            <td style='padding: 1px;'>". $field_key['DocDueDate'] ."</td>
                            <td style='text-align: right; padding: 1px;'>". number_format($field_key['DocTotal']) ."</td>
                        </tr>";
                        $no++;
                        }
                        $option .=' </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->';

                    return $option;

        }
    }
    public function actionApprovedView(){
        $option = '';
        if($_POST){
            $model = ModelInvTrackHead::find()
            ->where(['noinvoice'=>$_POST['invoice']])
            ->One();
            if($model->status == 1){
                $option = 'Silahkan Masukan Nama Kurir yang Bertanggung Jawab Mengirim Paket';
            }else if($model->status == 2){
                $option = 'Silahkan Masukan Penerima Paket';
            }else if($model->status == 3){
                $option = 'Silahkan Masukan Informasi Bawah Sudah Diterima Oleh PIC';
            }
            return $option;

        }
    }
    public function actionAssetmp(){
        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'User_Name',
                1 => 'Host_Name',
                2 => 'OS_Version',
                3 => 'Machine_Domain',
                4 => 'Logon_Server',
                5 => 'IP_Address',
                6 => 'CPU',
                7 => 'Memory',
                8 => 'Boot_Time',
                9 => 'Volumes',
                10 => 'Free_Space',
                11 => 'Services_Tag',
                12 => 'Manufacturer',
                13 => 'Version_Product',
                14 => 'Snapshot_Time',
             );
    
            
        
        $sql = "SELECT * FROM V_MP_ASSET where 1=1";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
    
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( User_Name LIKE '" . $requestData['search']['value'] . "%' ";
            $sql.=" OR Host_Name LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR OS_Version LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR IP_Address LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Logon_Server LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Machine_Domain LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Manufacturer LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Services_Tag LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Version_Product LIKE '%" . $requestData['search']['value'] . "%'";        
            $sql.=" OR Boot_Time LIKE '%" . $requestData['search']['value'] . "%')";        
        }
        
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY Time_Stamp DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
        
            $tombol = "<button type='button' class='btn btn-default' data-toggle='modal' 
                        data-target='#modal-xl' data-id=".$row['User_Name'].">Cetak Form</button>";
            $nestedData = array();
    
            $nestedData[] = $row["User_Name"];
            $nestedData[] = $row["Host_Name"];
            $nestedData[] = $row["OS_Version"];
            $nestedData[] = $row["Machine_Domain"];
            $nestedData[] = $row["Logon_Server"];
            $nestedData[] = $row["IP_Address"];            
            $nestedData[] = $row["CPU"];
            $nestedData[] = $row["Memory"];           
            $nestedData[] = $row["Boot_Time"];
            $nestedData[] = $row["Volumes"];
            $nestedData[] = $row["Free_Space"];
            $nestedData[] = $row["Services_Tag"];
            $nestedData[] = $row["Manufacturer"];
            $nestedData[] = $row["Version_Product"];
            $nestedData[] = $row["Snapshot_Time"];
            $nestedData[] = $tombol;
            
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
    public function actionCls(){
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("
        WITH CTE AS
        (
            SELECT rn = ROW_NUMBER()
                        OVER(
                          PARTITION BY User_Name,Host_Name ORDER BY Time_Stamp DESC), *
            FROM [192.168.1.25].mp_aset.dbo.BGInfoTable
        )
        Delete FROM cte
        WHERE  rn > 1
        ");                                      
        $model = $sql->Execute();
        $data = [
            'data'=>$model
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionCariserahterima(){
        $sql = "SELECT * FROM V_MP_ASSET";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $output = array();        

        foreach($data as $i => $models):
            $output[$i] = array(
                          $models['User_Name'],
                          $models['Host_Name'],                                              
                          '<i data-id='.$models["User_Name"].';'.$models["Host_Name"].';'.$models["Manufacturer"].' 
                            data-id2='.$models["Services_Tag"].';'.$models["Version_Product"].'
                          class="fas fa-plus add"></i>'
            );


        endforeach;
                
        $data = json_encode($output);
        $data = [
            'data'=>$output
        ];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;

    }
    public function actionStatusaset(){
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT COUNT(DISTINCT Host_Name) as jumlah FROM [192.168.1.25].mp_aset.dbo.BGInfoTable where host_name like '%NB%'");
        $PC = $connection->createCommand("SELECT COUNT(DISTINCT Host_Name) as jumlah FROM [192.168.1.25].mp_aset.dbo.BGInfoTable where host_name like '%PC%'");
        $BOP = $connection->createCommand("SELECT COUNT(DISTINCT Host_Name) as jumlah FROM [192.168.1.25].mp_aset.dbo.BGInfoTable where host_name like '%BOP%'");
        $ANX = $connection->createCommand("SELECT COUNT(DISTINCT Host_Name) as jumlah FROM [192.168.1.25].mp_aset.dbo.BGInfoTable where host_name like '%ANX%'");
        $WTC = $connection->createCommand("SELECT COUNT(DISTINCT Host_Name) as jumlah FROM [192.168.1.25].mp_aset.dbo.BGInfoTable where host_name like '%WTC%'");
        $modelNB = $NB->queryAll();
        $modelPC = $PC->queryAll();
        $modelBOP = $BOP->queryAll();
        $modelANX = $ANX->queryAll();
        $modelWTC = $WTC->queryAll();

        $data = [
            'NB'=>$modelNB,
            'PC'=>$modelPC,
            'BOP'=>$modelBOP,
            'ANX'=>$modelANX,
            'WTC'=>$modelWTC,
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionUploadserah(){
        
        $model = ModelSerahterimaasset::findOne(['id'=>$_POST['inputan']]);
        $uploadDir = Yii::getAlias('@webroot/upload/serahterima/');
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $nmfilenya = $model->User_Name.$model->Services_Tag.".".$ext;
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $nmfilenya);

        $model->namaFile = $nmfilenya;
        $model->UploadTime = date('Y-m-d H:i:s');
        $model->ModifiedBy = Yii::$app->user->identity->username;
        $model->ModifiedDatetime = date('Y-m-d H:i:s');
        $model->save(false);

        $data = [
            'status'=>'sukses',

        ];
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;

        
		
		
    }
    public function actionAssetwh(){
        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'ItemCode',
                1 => 'ItemName',
             );
    
            
        
        $sql = "SELECT * FROM V_ItemCode where 1=1";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
    
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( ItemCode LIKE '" . $requestData['search']['value'] . "%' ";
            $sql.=" OR ItemName LIKE '%" . $requestData['search']['value'] . "%')";     
        }
        
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY ItemName ASC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
        
            $tombol = "<button type='button' class='btn btn-default' data-toggle='modal' 
                        data-target='#modal-xl' data-id=".$row['ItemCode'].">Cetak Form</button>";
            $cetak = "<a href=\"/asset/printqrwh?id=122022899\" title=\"Print\" target=\"_blank\">&nbsp;&nbsp;<span class=\"fas fa-qrcode\">&nbsp;&nbsp;</span></a>";
            $url = Url::to(['asset/printqrwh', 'id' =>$row['ItemCode']]);
            $cetak2 = Html::a('&nbsp&nbsp<span class="fas fa-qrcode">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Print'),'target'=>'_blank']);
            $nestedData = array();
    
            $nestedData[] = $row["ItemCode"];
            $nestedData[] = $row["ItemName"];
            $nestedData[] = $row["OnHand"];
            $nestedData[] = $cetak2;
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
    public function actionItemcodesearch(){

        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("
        SELECT T0.[ItemCode],T1.[ItemName],  T0.[WhsCode], CONVERT(float,T0.[OnHand]) AS OnHand,T2.[UgpCode], T1.[InvntryUom] 
        FROM [MP-8].KBM_LIVE.dbo.OITW T0  INNER JOIN [MP-8].KBM_LIVE.dbo.OITM T1 ON T0.[ItemCode] = T1.[ItemCode] 
        INNER JOIN [MP-8].KBM_LIVE.dbo.OUGP T2 ON T1.[UgpEntry] = T2.[UgpEntry] WHERE T0.[WhsCode] = 'JKMP0001'
        AND T0.ItemCode ='".$_POST['data']."'");
        $modelNB = $NB->queryAll();


        $NMDetail = $connection->createCommand("
        SELECT T0.[ItemCode], T3.[ItemName], T0.[WhsCode], T1.[BatchNum], T1.[SuppSerial] AS 'BatchAttributes',convert(varchar(10), T1.[ExpDate], 105) ExpDate , CONVERT(float,T1.[Quantity]) AS 'Batch_Qty', T0.[OnHand] AS 'Total Stock SAP', T4.[UgpName], T3.[InvntryUom] 
        FROM [MP-8].KBM_LIVE.[dbo].[OITW] T0 
		LEFT  JOIN [MP-8].KBM_LIVE.[dbo].OIBT T1 ON T0.WhsCode = T1.WhsCode AND T0.ItemCode = T1.ItemCode 
		INNER JOIN [MP-8].KBM_LIVE.[dbo].[OITM]  T3 ON T0.[ItemCode] = T3.[ItemCode] 
		INNER JOIN [MP-8].KBM_LIVE.[dbo].OUGP T4 ON T3.[UgpEntry] = T4.[UgpEntry] 
        WHERE T0.[WhsCode] = 'JKMP0001' AND T1.[Quantity] > 0 AND T0.ItemCode ='".$_POST['data']."' ORDER By T0.[ItemCode]");
        $modelNBTotal = $NMDetail->queryAll();

        $option = "";
        if(count($modelNB)>0){
            $header = "
            <div class=\"col-sm-6 invoice-col\">
                <b>Item Code : ".$modelNB[0]['ItemCode']."</b><br>
                <br>
                <b>WHS Code:</b> ".$modelNB[0]['WhsCode']."<br>
                <b>UoM Group Code:</b> ".$modelNB[0]['UgpCode']."
    
            </div>
            <div class=\"col-sm-6 invoice-col\">
                <b>Item Name : ".$modelNB[0]['ItemName']."</b><br>
                <br>
                <b>Qty:</b> ".$modelNB[0]['OnHand']."<br>
                <b>Inventory UOM:</b> ".$modelNB[0]['InvntryUom']."
            </div><br>";

        
            $option .= '<div class="row tableini">
            <div class="col-sm-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Batch Number</th>
                            <th>Batch Atributs</th>
                            <th>Exp Date</th>
                            <th>Batch Qty</th>
                            <th>UGP Name</th>
                            <th>Inventory UOM</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNBTotal as $field_key) {
                            $option .="<tr>

                                <td style='padding: 1px;'>". $field_key['BatchNum'] ."</td>
                                <td style='padding: 1px;'>". $field_key['BatchAttributes'] ."</td>
                                <td style='padding: 1px;'>". $field_key['ExpDate'] ."</td>
                                <td style='padding: 1px;'>". $field_key['Batch_Qty'] ."</td>

                                <td style='padding: 1px;'>". $field_key['UgpName'] ."</td>
                                <td style='padding: 1px;'>". $field_key['InvntryUom'] ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';


            $data = [
                'header'=>$header,
                'datanya'=>$option

            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{
            $data = [
                'datanya'=>'kosong',
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionBatchinginv(){
        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'batching',
                1 => 'perusahan',
                2 => 'Tanggal_Input',
                3 => 'status',
             );

        $sql = "SELECT a.batching,perusahaan, CONVERT(date, a.created_time) Tanggal_Input, b.status
        FROM INV_TRACK_HEAD a
        JOIN INV_STATUS b ON b.id = a.status
        WHERE a.batching is NOT NULL";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
    
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( batching LIKE '" . $requestData['search']['value'] . "%' ";
            $sql.=" OR perusahaan LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR Tanggal_Input LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR status LIKE '%" . $requestData['search']['value'] . "%')";     
        }
        $sql .= " GROUP BY a.batching, a.perusahaan,CONVERT(date, a.created_time),b.status";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalData = count($data);
        $totalFiltered = count($data);
        $sql.=" ORDER BY CONVERT(date, a.created_time) DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $data = array();
        foreach ($result as $key => $row){
           
            $url = Url::to(['asset/printqrwh', 'id' =>$row['batching']]);
            $cetak = Html::a('&nbsp&nbsp<span class="fas fa-envelope">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Kirim'),'target'=>'_blank']);

            $tombol = "<button type=\"button\" id=\"viewx\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#exampleModal\"  data-id=".$row['batching'].">
                        <i class=\"fa fa-eye\" aria-hidden=\"true\"></i></button>&nbsp&nbsp";
            $tombol2 = "<button type=\"button\" id=\"sentemail\" class=\"btn btn-primary btn-sm\" data-idx=".$row['batching'].">
                        <i class=\"fa fa-envelope\" aria-hidden=\"true\"></i></button>&nbsp&nbsp";
            $nestedData = array();
    
            $nestedData[] = $row["batching"];
            $nestedData[] = $row["perusahaan"];
            $nestedData[] = $row["Tanggal_Input"];
            $nestedData[] = $row["status"];
            $nestedData[] = $tombol.$tombol2;
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
    public function actionBatchPreview(){
        $option = '';
        if($_POST){
            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT a.*, (b.status) AS dcry FROM INV_TRACK_HEAD a
            JOIN INV_STATUS b ON b.id = a.status
            where batching = '".$_POST['data']."'");
        $model = $sql->queryAll();


        $option .= '<div class="row">
        <div class="col-sm-12 table-responsive">
        <font size="1" face="Courier New" >
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th>No.Invoice</th>
                        <th>Doc Date</th>
                        <th>DocTotal</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Created Time</th>
                    </tr>
                </thead>
                <tbody>';
                    $no = 1;
                    $jumlahnyaT = 0;
                    foreach ($model as $field_key) {
                        $connection = \Yii::$app->db;
                        $sql2 = $connection->createCommand("SELECT DocNum, 
                        CONVERT(varchar, DocDate, 23)DocDate,
                        CONVERT(varchar, DocDueDate, 23)DocDueDate,DocTotal 
                        from [MP-8].KBM_LIVE.dbo.OINV  where DocNum ='".$field_key['noinvoice']."'");
                        $modelx = $sql2->queryAll();
                        $jumlahnyaT = $jumlahnyaT + $modelx[0]['DocTotal'];
                        $option .="<tr>
                            <td style='padding: 1px;'>". $no ."</td>
                            <td style='padding: 1px;'>". $field_key['noinvoice'] ."</td>
                            <td style='padding: 1px;'>". $modelx[0]['DocDate'] ."</td>
                            <td style='padding: 1px;'> Rp.". number_format($modelx[0]['DocTotal']) ."</td>
                            <td style='padding: 1px;'>". $field_key['perusahaan'] ."</td>
                            <td style='padding: 1px;'>". $field_key['dcry'] ."</td>
                            <td style='padding: 1px;'>". $field_key['created_by'] ."</td>
                            <td style='padding: 1px;'>". $field_key['created_time'] ."</td>
                        </tr>";
                        $no++;
                        }
                        $option .='<tr> 
                        <td style=\'padding: 1px;\' colspan="3"><center>Jumlah</center></td>
                        <td style=\'padding: 1px;\'>Rp.'.number_format($jumlahnyaT).'</td>
                        <td style=\'padding: 1px;\' colspan="4"></td>
                        </tr>
                            </tbody>
                            </table></font>
                        </div><!-- /.col -->
                    </div><!-- /.row -->';

                    return $option;

        }
    }
    public function actionOpnameinsert(){    
        if($_POST){
            $id      = $_POST['id'];
            $code    = $_POST['code'];
            $statusx = $_POST['statusx'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row tableini">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="otherx">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Satuan</th>
                            <th>Stock In SAP</th>
                            <th>Stock Real</th>
                            <th>Selisih</th>
                            <th>Expire Date</th>
                            <th>Created By</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            if($statusx == 1 AND Yii::$app->user->identity->role == 8){
                                $statuss = "<center><i class='fa fa-trash delete' aria-hidden='true' id='deletex' data-id=".$field_key['id']."></i></center>";
                            }else{
                                $statuss = "";
                            }
                            $option .="<tr>
                                <td>". $field_key['itemcode'] ."</td>
                                <td>". $field_key['itemname'] ."</td>
                                <td>". $field_key['satuan'] ."</td>
                                <td>". $field_key['stockInSAP'] ."</td>
                                <td>". $field_key['stockReal'] ."</td>
                                <td>". $field_key['selisih'] ."</td>
                                <td>". $field_key['expiredate'] ."</td>
                                <td>". $field_key['createdBy'] ."</td>
                                <td> ". $statuss ."</td>

                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionOpnamesearch(){    
        if($_POST){
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("
        SELECT T0.[ItemCode],T1.[ItemName], T0.[WhsCode], CONVERT(float,T0.[OnHand]) AS OnHand,T2.[UgpCode],
        T1.[InvntryUom]
        FROM [MP-8].KBM_LIVE.dbo.OITW T0 INNER JOIN [MP-8].KBM_LIVE.dbo.OITM T1 ON T0.[ItemCode] = T1.[ItemCode]
        INNER JOIN [MP-8].KBM_LIVE.dbo.OUGP T2 ON T1.[UgpEntry] = T2.[UgpEntry] WHERE T0.[WhsCode] = 'JKMP0001'
        AND T0.ItemCode ='".$_POST['data']."'");
        $datanya = $NB->queryAll();
                if(count($datanya)>0){

                    $data = [
                    'datanya'=>$datanya[0]
                    ];
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $data;
                }else{
                $data = [
                'datanya'=>'kosong',
                ];
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $data;
                }
        }else{
            $data = [
            'datanya'=>'kosong',
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionOpnameinsertdata(){    

        $input = new ModelWarehouseStockOPDetail();

        $itemcodes = $_POST['itemcode'];
        $id = $_POST['id'];
        $code = $_POST['code'];
        $connection = \Yii::$app->db;
        $NB = $connection->createCommand("SELECT * FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode = '$itemcodes' ORDER BY id DESC ");
        $modelNB = $NB->queryAll();

        if(count($modelNB) > 0){
            $selisih = $modelNB[0]['selisih'] - $_POST['stckreal'];
        }else{
            $selisih = $_POST['selisih'];
        }

        $input->id_head = $_POST['id'];
        $input->code_head = $_POST['code'];
        $input->itemcode = $_POST['itemcode'];
        $input->itemname = $_POST['itemname'];
        $input->satuan = $_POST['uom'];
        $input->stockInSAP = $_POST['stocksap'];
        $input->stockReal = $_POST['stckreal'];
        $input->expiredate = $_POST['exp'];
        $input->noregkesehatan = $_POST['noregkes'];
        $input->kondisi = $_POST['kondisi'];
        $input->selisih = $selisih;
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);

        $data = [
        'data'=>'success',
        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionDeletedataopname(){
        $id = $_POST['data'];
        $opname = ModelWarehouseStockOPDetail::findOne($id);
        $opname->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionCekavail(){
        if($_POST){
            $id      = $_POST['id'];
            $code    = $_POST['code'];
            $itemcode    = $_POST['itemcode'];

            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT count(*) jumlah FROM WH_STCKOP_DETAIL WHERE id_head = $id AND code_head='$code' AND itemcode = '$itemcode' ");
            $modelNB = $NB->queryAll();
                $data = [
                    'datanya'=>$modelNB[0]
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    public function actionAlkesmaintenance(){    
        if($_POST){
            $id      = $_POST['id'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES_MAINTENANCE WHERE codeAsset = '$id' ORDER BY id ASC ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row maintainenance">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="otherx">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Institusi/Teknisi</th>
                            <th>No. LK</th>
                            <th>Hasil</th>
                            <th>Action Plan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $statuss = "<center><i class='fa fa-trash delete' aria-hidden='true' id='deletex' data-id=".$field_key['id']."></i></center>";
                            $option .="<tr>
                                <td>". $field_key['tgl_maintenance'] ."</td>
                                <td>". $field_key['jenis'] ."</td>
                                <td>". $field_key['teknisi'] ."</td>
                                <td>". $field_key['nosr'] ."</td>
                                <td>". $field_key['hasil'] ."</td>
                                <td>". $field_key['actionplan'] ."</td>
                                <td> ". $statuss ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionAlkesmaintinsert(){

        $input = new ModeWhAssetAlkesMaintenance();
        $input->codeAsset = $_POST['codeAset'];
        $input->tgl_maintenance = $_POST['tgl_maint'];
        $input->jenis = $_POST['jenis'];
        $input->teknisi = $_POST['teknisi'];
        $input->nosr = $_POST['nosr'];
        $input->actionplan = $_POST['actionplan'];
        $input->hasil = $_POST['hasil'];
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);
        $input2 =  ModeWhAssetAlkes::findOne(['codeAset' => $_POST['codeAset']]);
        $input2->kondisi = $_POST['hasil'];
        $input2->save(false);
        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;    
    }
    public function actionDeletedatamaint(){
        $id = $_POST['data'];
        $maint = ModeWhAssetAlkesMaintenance::findOne($id);
        $maint->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionAlkestracking(){    
        if($_POST){
            $id      = $_POST['id'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES_TRACKING WHERE codeAsset = '$id' ORDER BY id ASC ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row tracking">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="trackingtable">
                    <thead>
                        <tr>
                            <th>Status Barang</th>
                            <th>No Inventory Transfer</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Tanggal Penerimaan</th>
                            <th>Keterangan</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $statuss = "<center><i class='fa fa-trash deletetracking' aria-hidden='true' id='deletextrack' data-id=".$field_key['id']."></i></center>";
                            $option .="<tr>
                                <td>". $field_key['StatusBarang'] ."</td>
                                <td>". $field_key['noInvTrans'] ."</td>
                                <td>". $field_key['tgl_pengiriman'] ."</td>
                                <td>". $field_key['tgl_penerimaan'] ."</td>
                                <td>". $field_key['keterangan'] ."</td>
                                <td> ". $statuss ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionAlkestrackinginsert(){

        $input = new ModelWhAssetAlkesTracking();
        $input->codeAsset = $_POST['codeAsettracking'];
        $input->StatusBarang = $_POST['stsbrg'];
        $input->noInvTrans = $_POST['nit'];
        $input->tgl_pengiriman = $_POST['tglkirim'];
        $input->tgl_penerimaan = $_POST['tglpnrm'];
        $input->keterangan = $_POST['keterangan'];
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);
        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;    
    }
    public function actionDeletedatatracking(){
        $id = $_POST['data'];
        $maint = ModelWhAssetAlkesTracking::findOne($id);
        $maint->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionAlkescalibration(){    
        if($_POST){
            $id      = $_POST['id'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = '$id' ORDER BY id ASC ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row calibration">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="calibrationtable">
                    <thead>
                        <tr>
                            <th>Tanggal Kalibrasi</th>
                            <th>Tanggal Berakhir Kalibrasi</th>
                            <th>Institusi</th>
                            <th>No. Sertifikat</th>
                            <th>Hasil</th>
                            <th>File Kalibrasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $download = "File Tidak Ada";
                            $statuss = "<center><i class='fa fa-trash deletecalibration' aria-hidden='true' id='deletextrack' data-id=".$field_key['id']."></i></center>";
                            if($field_key['filesertifikat']!== 'calibration_AMD-4_'){
                                $download = "<a href=\"/upload/alkeswh/". $field_key['filesertifikat'] ."\" download>Download File</a>";
                            }
                            $option .="<tr>
                                <td>". $field_key['tgl_kalibrasi'] ."</td>
                                <td>". $field_key['tgl_endkalibrasi'] ."</td>
                                <td>". $field_key['institusi'] ."</td>
                                <td>". $field_key['nosertifikat'] ."</td>
                                <td>". $field_key['hasil'] ."</td>
                                <td>".$download."</td>
                                <td> ". $statuss ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionAlkescalibrationinsert(){

        $targetfolder = "upload/alkeswh/";
        $targetfolder = $targetfolder . basename('calibration_'.$_POST['codeAsetcalibration'].'_'.$_FILES['docupload']['name']) ;
        move_uploaded_file($_FILES['docupload']['tmp_name'], $targetfolder);

        $input = new ModelWhAssetAlkesCalibration();
        $input->codeAsset = $_POST['codeAsetcalibration'];
        $input->tgl_kalibrasi = $_POST['tgl_kalibrasi'];
        $input->tgl_endkalibrasi = $_POST['tgl_endkalibrasi'];
        $input->institusi = $_POST['institusi'];
        $input->nosertifikat = $_POST['nosrtifikat'];
        $input->hasil = $_POST['hasilcalibration'];
        $input->filesertifikat = 'calibration_'.$_POST['codeAsetcalibration'].'_'.$_FILES['docupload']['name'];
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);
        $input2 =  ModeWhAssetAlkes::findOne(['codeAset' => $_POST['codeAsetcalibration']]);
        $input2->tglKalibrasi = $_POST['tgl_kalibrasi'];
        $input2->tglexpKalibrasi = $_POST['tgl_endkalibrasi'];
        $input2->save(false);
        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;    
    }
    public function actionDeletedatacalibration(){
        $id = $_POST['data'];
        $maint = ModelWhAssetAlkesCalibration::findOne($id);
        $maint->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionAlkesrepair(){    
        if($_POST){
            $id      = $_POST['id'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES_REPAIR WHERE codeAsset = '$id' ORDER BY id ASC ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row repair">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="repairtable">
                    <thead>
                        <tr>
                            <th>Tanggal Repair</th>
                            <th>Keluhan</th>
                            <th>Teknisi</th>
                            <th>Hasil</th>
                            <th>Sparepart</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $statuss = "<center><i class='fa fa-trash deleterepair' aria-hidden='true' id='deleterepair' data-id=".$field_key['id']."></i></center>";
                            $option .="<tr>
                                <td>". $field_key['tgl_repair'] ."</td>
                                <td>". $field_key['keluhan'] ."</td>
                                <td>". $field_key['teknisi'] ."</td>
                                <td>". $field_key['hasil'] ."</td>
                                <td>". $field_key['sparepart'] ."</td>
                                <td> ". $statuss ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionAlkesrepairinsert(){

        $input = new ModelWhAssetAlkesRepair();
        $input->codeAsset = $_POST['codeAsetrepair'];
        $input->tgl_repair = $_POST['tgl_repair'];
        $input->keluhan = $_POST['keluhan'];
        $input->teknisi = $_POST['teknisirepair'];
        $input->hasil = $_POST['hasilrepair'];
        $input->sparepart = $_POST['sparepart'];
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);
        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;    
    }
    public function actionDeletedatarepair(){
        $id = $_POST['data'];
        $maint = ModelWhAssetAlkesRepair::findOne($id);
        $maint->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionAlkesacessories(){    
        if($_POST){
            $id      = $_POST['id'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM WH_ASSET_ALKES_ACESSORIES WHERE codeAsset = '$id' ORDER BY id ASC ");
            $modelNB = $NB->queryAll();
            $option .= '<div class="row acessories">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped" id="acessoriestable">
                    <thead>
                        <tr>
                            <th>Acessories</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $statuss = "<center><i class='fa fa-trash deleteacessories' aria-hidden='true' id='deleteacessories' data-id=".$field_key['id']."></i></center>";
                            $option .="<tr>
                                <td>". $field_key['acessories'] ."</td>
                                <td>". $field_key['keterangan'] ."</td>
                                <td> ". $statuss ."</td>
                            </tr>";
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionAlkesacessoriesinsert(){

        $input = new ModelWhAssetAlkesAcessories();
        $input->codeAsset = $_POST['codeAsetacessories'];
        $input->acessories = $_POST['acessoriesname'];
        $input->keterangan = $_POST['keteranganacessories'];
        $input->createdTime = date('Y-m-d H:i:s');
        $input->createdBy = Yii::$app->user->identity->username;
        $input->save(false);
        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;    
    }
    public function actionDeletedataacessories(){
        $id = $_POST['data'];
        $maint = ModelWhAssetAlkesAcessories::findOne($id);
        $maint->delete();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionGetProvider(){ 

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'provider_id',
                1 => 'provider_name',
             );
        
       $sql = "SELECT provider_id,provider_name FROM MAS442021.dbo.MAS_PROVIDER 
       WHERE deleted_status = 0 AND  status_id = 1";
       

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
     
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( provider_name LIKE '%" . $requestData['search']['value'] . "%')";
            // $sql.=" OR CardName LIKE '" . $requestData['search']['value'] . "%')";
            // $sql.=" OR province LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR city LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR postal_code LIKE '" . $requestData['search']['value'] . "%')";          
        }
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
       
        $data = array();
        $i=1;
        
        foreach ($result as $key => $row)
        {
            $nestedData = array();
            $nestedData[] = $row["provider_name"];
            $nestedData[] = "<center><i class=\"addprovider fas fa-plus\" aria-hidden=\"true\" data-id=\"".$row['provider_id'].';'.$row['provider_name']."\"></i></center>";
            $data[] = $nestedData;            
            $i++;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), 
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
        
    }
    public function actionSumrebate(){    
        if($_POST){
            $dari      = $_POST['dari'];
            $sampai      = $_POST['sampai'];

            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT sum(charge) jumlah,providerName provider 
            FROM MAS_REBATE WHERE datePaid BETWEEN '$dari' AND '$sampai'
            GROUP BY providerName");
            $modelNB = $NB->queryAll();
            $option .= '
                <table class="table table-bordered table-striped" id="rebatetable">
                    <thead>
                        <tr>
                            <th>Provider Name</th>
                            <th>Charge</th>
                            <th>Discount</th>
                            <th>Rebate</th>
                            <th>PaidDate</th>

                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $providername = $field_key['provider'];
                            $NBX = $connection->createCommand("SELECT TOP 1 *  
                            FROM MAS_PROVIDER_REBATE WHERE providerName = '$providername'");
                            $modelNBX = $NBX->queryAll();

                            $providersx = $connection->createCommand("SELECT convert(varchar(7), datePaid, 126) datePaid
                            FROM MAS_REBATE WHERE datePaid BETWEEN '$dari' AND '$sampai' AND providerName = '$providername' GROUP by convert(varchar(7), datePaid, 126)");
                            $modelprov = $providersx->queryAll();
                            $paidate ='';
                            foreach ($modelprov as $field_prov) {
                            $paidate .= $field_prov['datePaid'].' -- ';
                            }
                            if(isset($modelNBX[0]['providerName'])){
                                if($modelNBX[0]['isdetail'] == 0){
                                    $rebatexx = $modelNBX[0]['rebate'];
                                    $discount = $field_key['jumlah']*($rebatexx/100);
                                    $option .="<tr>
                                        <td>". $field_key['provider'] ."</td>
                                        <td>". number_format(round($field_key['jumlah'])) ."</td>
                                        <td>$rebatexx %</td>
                                        <td>".number_format(round($discount))."</td>
                                        <td>$paidate</td>
    
                                    </tr>";
                                }else{
                                    $rebatexx = $modelNBX[0]['rebate'];
                                    $discount = $field_key['jumlah']*($rebatexx/100);
                                    $option .="<tr>
                                        <td>". $field_key['provider'] ."</td>
                                        <td>". number_format(round($field_key['jumlah'])) ."</td>
                                        <td>$rebatexx %</td>
                                        <td>".number_format(round(0))."</td>
                                        <td>$paidate</td>
    
                                    </tr>";
                                }
                            }

                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionUploadrebatedata(){    
        if($_POST){
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT codeUpload,CONVERT(char(10), createdTime,126) createdTime ,count(codeUpload) jumlah
            FROM MAS_REBATE GROUP BY codeUpload, CONVERT(char(10), createdTime,126)");
            $modelNB = $NB->queryAll();


            $i = 1;
            $option .= '
                <table class="table table-bordered table-striped" id="datauplaodir">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Tanggal Upload</th>
                            <th>Jumlah</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $view =  Html::a('<i class="fas fa-eye"></i>', ['rebate/detailupload','id'=> $field_key['codeUpload']]);

                                $option .="<tr>
                                    <td>". $i ."</td>
                                    <td>".$field_key['codeUpload'] ."</td>
                                    <td>".$field_key['createdTime'] ."</td>
                                    <td>".$field_key['jumlah'] ."</td>
                                    <td>".$view."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class=\"fas fa-trash delete\"  aria-hidden='true' id='deleteuploadrebate' data-id=".$field_key['codeUpload']."></i></td>

                                </tr>";
                            
                            $i++;
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionDeletedatarebat(){
        $id = $_POST['data'];
        // $maint = ModelMasRebate::find($id);
        // $maint->execute();
        $connection = \Yii::$app->db;
        $connection->createCommand("DELETE FROM MAS_REBATE WHERE codeUpload='$id'")
        ->execute();

        $data = [
            'data'=>'success',
            ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionViewrebateupload(){    
        if($_POST){
            $datax = $_POST['data'];
            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT * FROM MAS_REBATE WHERE codeUpload = '$datax' ");
            $modelNB = $NB->queryAll();


            $i = 1;
            $charge = 0;
            $approved = 0;
            $bayarDimuka = 0;
            $excess = 0;

            $option .= '
                <table class="table table-bordered table-striped" id="dataviewupload">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Batch CLaim Number</th>
                            <th>Claim Number</th>
                            <th>Invoice Number</th>
                            <th>Receive Date</th>
                            <th>Admission Date</th>
                            <th>Discharge Date</th>
                            <th>Member</th>
                            <th>Card Number</th>
                            <th>Employee Name</th>
                            <th>Relasi</th>
                            <th>Id Customer</th>
                            <th>Department</th>
                            <th>Provider Name</th>
                            <th>Bank</th>
                            <th>Cabang</th>
                            <th>Rekening</th>
                            <th>Atas Nama</th>
                            <th>Email</th>
                            <th>dx 1</th>
                            <th>Decription</th>
                            <th>dx2</th>
                            <th>Decription</th>
                            <th>Type</th>
                            <th>Service</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Charge</th>
                            <th>Approved</th>
                            <th>Bayar Dimuka</th>
                            <th>Excess</th>
                            <th>User Mas</th>
                            <th>Due Date</th>
                            <th>Perusahaan</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Job Position</th>
                            <th>Date Checked</th>
                            <th>Date Approved</th>
                            <th>Date Paid</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $charge = $charge + $field_key['charge'];
                            $approved = $approved + $field_key['approved'];
                            $bayarDimuka = $bayarDimuka + $field_key['bayarDimuka'];
                            $excess = $excess + $field_key['excess'];
                            $option .="<tr>
                                    <td>". $i ."</td>
                                    <td>".$field_key['batchNumber']."</td>
                                    <td>".$field_key['claimNumber']."</td>
                                    <td>".$field_key['InvoiceNumber']."</td>
                                    <td>".$field_key['receiveDate']."</td>
                                    <td>".$field_key['admissionDate']."</td>
                                    <td>".$field_key['dischargeDate']."</td>
                                    <td>".$field_key['member']."</td>
                                    <td>".$field_key['cardNumber']."</td>
                                    <td>".$field_key['employeeName']."</td>
                                    <td>".$field_key['relasi']."</td>
                                    <td>".$field_key['idCustomer']."</td>
                                    <td>".$field_key['department']."</td>
                                    <td>".$field_key['providerName']."</td>
                                    <td>".$field_key['bank']."</td>
                                    <td>".$field_key['cabang']."</td>
                                    <td>".$field_key['rekening']."</td>
                                    <td>".$field_key['atasNama']."</td>
                                    <td>".$field_key['email']."</td>
                                    <td>".$field_key['dx']."</td>
                                    <td>".$field_key['dxDescription']."</td>
                                    <td>".$field_key['dx2']."</td>
                                    <td>".$field_key['dx2Description']."</td>
                                    <td>".$field_key['type']."</td>
                                    <td>".$field_key['services']."</td>
                                    <td>".$field_key['remarks']."</td>
                                    <td>".$field_key['status']."</td>
                                    <td>".$field_key['charge']."</td>
                                    <td>".$field_key['approved']."</td>
                                    <td>".$field_key['bayarDimuka']."</td>
                                    <td>".$field_key['excess']."</td>
                                    <td>".$field_key['userMas']."</td>
                                    <td>".$field_key['dueDate']."</td>
                                    <td>".$field_key['perusahaan']."</td>
                                    <td>".$field_key['gender']."</td>
                                    <td>".$field_key['birthday']."</td>
                                    <td>".$field_key['jobPosition']."</td>
                                    <td>".$field_key['dateCheked']."</td>
                                    <td>".$field_key['dateApproved']."</td>
                                    <td>".$field_key['datePaid']."</td>

                                </tr>";
    
                            $i++;
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $sum = [
                    $charge ,
                    $approved ,
                    $bayarDimuka ,
                    $excess ,
                ];
                $data = [
                    'datanya'=>$option,
                    'detail'=>$sum,

                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionScanInvPreview(){
        $option = '';
        if($_POST){
            $connection = \Yii::$app->db;
            $sql = $connection->createCommand("SELECT a.*, (b.status) AS dcry FROM INV_TRACK_HEAD a
            JOIN INV_STATUS b ON b.id = a.status
            where noinvoice = '".$_POST['data']."'");
            $model = $sql->queryAll();
            $createdtime = $model[0]['created_time'];
            $perusahaanx = $model[0]['perusahaan'];
            $dari = date('Y-m-d', strtotime($createdtime));
            $sampai = date('Y-m-d', strtotime($createdtime));
            $sql2 = $connection->createCommand("SELECT a.*, (b.status) AS dcry FROM INV_TRACK_HEAD a
            JOIN INV_STATUS b ON b.id = a.status
            where perusahaan = '$perusahaanx' and created_time between '$dari 00:00:00' AND  '$sampai 23:00:00' ");
            $model2 = $sql2->queryAll();

        $option .= '<div class="row tablesnya">
        <div class="col-sm-12 table-responsive">
        <font size="1" face="Courier New" >
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th>No.Invoice</th>
                        <th>Doc Date</th>
                        <th>DocTotal</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Created Time</th>
                    </tr>
                </thead>
                <tbody>';
                    $no = 1;
                    $jumlahnyaT = 0;
                    foreach ($model2 as $field_key) {
                        $connection = \Yii::$app->db;
                        $sql2 = $connection->createCommand("SELECT DocNum, 
                        CONVERT(varchar, DocDate, 23)DocDate,
                        CONVERT(varchar, DocDueDate, 23)DocDueDate,DocTotal 
                        from [MP-8].KBM_LIVE.dbo.OINV  where DocNum ='".$field_key['noinvoice']."'");
                        $modelx = $sql2->queryAll();
                        $jumlahnyaT = $jumlahnyaT + $modelx[0]['DocTotal'];
                        $option .="<tr>
                            <td style='padding: 1px;'>". $no ."</td>
                            <td style='padding: 1px;'>". $field_key['noinvoice'] ."</td>
                            <td style='padding: 1px;'>". $modelx[0]['DocDate'] ."</td>
                            <td style='padding: 1px;'> Rp.". number_format($modelx[0]['DocTotal']) ."</td>
                            <td style='padding: 1px;'>". $field_key['perusahaan'] ."</td>
                            <td style='padding: 1px;'>". $field_key['dcry'] ."</td>
                            <td style='padding: 1px;'>". $field_key['created_by'] ."</td>
                            <td style='padding: 1px;'>". $field_key['created_time'] ."</td>
                        </tr>";
                        $no++;
                        }
                        $option .='<tr> 
                        <td style=\'padding: 1px;\' colspan="3"><center>Jumlah</center></td>
                        <td style=\'padding: 1px;\'>Rp.'.number_format($jumlahnyaT).'</td>
                        <td style=\'padding: 1px;\' colspan="4"></td>
                        </tr>
                            </tbody>
                            </table></font>
                        </div><!-- /.col -->
                    </div><!-- /.row -->';

                    return $option;

        }
    }
    public function actionInvUpdateKurir(){
        if($_POST){
        $invoicexs= $_POST['noinvoice'];
        $model = ModelInvTrackHead::findOne(['noinvoice' => $invoicexs]);
        // $sql = "SELECT DocNum invoice,CardName perusahaan FROM [MP-8].KBM_LIVE.dbo.OINV WHERE DocNum = '$models[0]'";
        $middle = strtotime($model->created_time);             // returns bool(false)
        $new_date = date('Y-m-d', $middle);   // returns 1970-01-01 00:00:00
        $new_date1= $new_date.' 00:00:00';
        $new_date2= $new_date.' 23:00:00';

        $sql = "SELECT * FROM INV_TRACK_HEAD where perusahaan = '$model->perusahaan' and created_time 
                between   '$new_date1' and ' $new_date2'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $sqlxx = "SELECT CardCode FROM [MP-8].KBM_LIVE.dbo.OINV WHERE DocNum = '$invoicexs'";
        $dataxx = Yii::$app->db->createCommand($sqlxx)->queryAll();
        $middle = strtotime($new_date);             // returns bool(false)
        $batchnya2 = $dataxx[0]['CardCode'].$middle;
        $clientnya = $dataxx[0]['CardCode'];
            foreach($data as $models):
                        $model = ModelInvTrackHead::findOne(['noinvoice' => $models['noinvoice']]);
                        $model->status = $_POST['status'];
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
                        $detail->status =$_POST['status'];
                        $detail->name = $_POST['username'];
                        $detail->description = $_POST['keterangan'];
                        $detail->createdTime = date('Y-m-d H:i:s');
                        $detail->createdBy =$_POST['username'];
                        $detail->save(false);
            endforeach;
        }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }   
    }
    public function actionSoDetail(){    
        ini_set('max_execution_time', 50000); //500 seconds

        if($_POST){
            $dari      = $_POST['dari'];
            $sampai      = $_POST['sampai'];

            $option = "";
            $connection = \Yii::$app->db;
            $NB = $connection->createCommand("SELECT replace(convert(NVARCHAR, T0.[DocDate], 103), ' ', '/') as DocDate,  T0.[DocNum] as SoNumber, 
            CASE WHEN T0.[DocType] = 'I' THEN 'Item' ELSE 'Service' END as SoType,
            CASE WHEN T0.[DocStatus] = 'C' THEN 'CLOSE' ELSE 'OPEN' END as SoStatus, T0.[CardCode], 
            T0.[CardName] as Customer, CONVERT(varchar, CONVERT(money, T0.[DocTotal]), 1 ) as DocTotal, 
            T1.[ItemCode], T1.[Dscription],T1.[unitMsr], CONVERT(INT, T1.[Quantity]) as Quantity, CONVERT(INT, T1.opencreqty) as OpenQuantity,
            CONVERT(varchar, CONVERT(money, T1.[Price]), 1 ) as Price, 
            CONVERT(varchar, CONVERT(money, T1.[LineTotal]), 1 ) as LineTotal,
            T2.Slpname as SalesName
            FROM [MP-8].KBM_LIVE.dbo.ORDR T0  
            INNER JOIN [MP-8].KBM_LIVE.dbo.RDR1 T1 ON T0.DocEntry = T1.DocEntry 
            INNER JOIN [MP-8].KBM_LIVE.dbo.OSLP T2 ON T2.SlpCode = T0.SlpCode
            WHERE T0.[DocDate] BETWEEN '$dari' AND '$sampai'
             ");
            $modelNB = $NB->queryAll();
            $no = 1;
            $option .= '
                <table class="table table-bordered table-striped" id="rebatetable">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>DocDate</th>
                        <th>SoNumber</th>
                        <th>SoType</th>
                        <th>SoStatus</th>
                        <th>CardCode</th>
                        <th>Customer</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>OpenQty</th>
                        <th>unitMsr</th>
                        <th>Price</th>
                        <th>LineTotal</th>
                        <th>SalesName</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($modelNB as $field_key) {
                            $option .= "<tr>
                            <td> $no</td>
                            <td> ".$field_key['DocDate']."</td>
                            <td> ".$field_key['SoNumber']."</td>
                            <td> ".$field_key['SoType']."</td>
                            <td> ".$field_key['SoStatus']."</td>
                            <td> ".$field_key['CardCode']."</td>
                            <td> ".$field_key['Customer']."</td>
                            <td> ".$field_key['Dscription']."</td>
                            <td> ".$field_key['Quantity']."</td>
                            <td> ".$field_key['OpenQuantity']."</td>
                            <td> ".$field_key['unitMsr']."</td>
                            <td> ".$field_key['Price']."</td>
                            <td> ".$field_key['LineTotal']."</td>
                            <td> ".$field_key['SalesName']."</td>
                            </tr>
                            ";
                            $no++;
                            }
                            $option .=' </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->';
                $data = [
                    'datanya'=>$option
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
            }else{
                $data = [
                    'datanya'=>'kosong',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionUpdateAr(){
        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'idcase',
                1 => 'client_number',
                2 => 'ar_number',
                3 => 'duedate',
                4 => 'case_category',
                5 => 'type',
                6 => 'client_name',
                7 => 'insured_name',
                8 => 'Priority',
                9 => 'status',
                10 => 'user_create',
                11 => 'date_create',
                12 => 'urutan',
               
                
             );
    
            
        
        $sql = "SELECT * FROM v_case_aplikasi where 1=1";
       
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
    
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( idcase LIKE '" . $requestData['search']['value'] . "%' ";
            $sql.=" OR info_client_number LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR case_category LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR type LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR client_name LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR insured_name LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR Priority LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR status LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR user_create LIKE '" . $requestData['search']['value'] . "%'";        
            $sql.=" OR date_create LIKE '" . $requestData['search']['value'] . "%')";        
        }
        
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY urutan DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db2->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
        
            $detail = '<a href= "aplikasi-detail-'.$row['idcase'].'"><i class="fa fa-search fa-3x" aria-hidden="true"></i></a>';
            $aksi =  ($row['idstatus'] == 1 ? Html::a('<i class="fa fa-pencil-alt fa-2x" aria-hidden="true"></i> | ',['//aplikasi/update','id'=>$row['idcase']]) : '-').
                        (isset($row['ar_number']) ? '' :'<i title="Update A/R" aria-hidden="true" data-toggle="modal" data-id='.$row['idcase'].' class="fa fa-random fa-2x arNumber" data-target=".ar-number"></i>' ).
                        (isset($row['duedate']) ? '' :'<i title="Update Due Date" aria-hidden="true" data-toggle="modal" data-id='.$row['idcase'].' class="fa fa-calendar fa-2x duedate" data-target=".duedatemodal"></i>' );
            $nestedData = array();
    
            $nestedData[] = $detail;
            $nestedData[] = $row["idcase"];
            $nestedData[] = $row["info_client_number"];
            $nestedData[] = $row["ar_number"];
            $nestedData[] = $row["duedate"];
            $nestedData[] = $row["case_category"];
            $nestedData[] = $row["type"];            
            $nestedData[] = $row["client_name"];
            $nestedData[] = $row["insured_name"];           
            $nestedData[] = $row["status"];
            $nestedData[] = $row["user_create"];
            $nestedData[] = $row["date_create"];
            $nestedData[] = $aksi;
            
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
    public function actionGetGlmas(){ 

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'urutan',
                1 => 'caseglnumber',
                2 => 'no_gl',
                3 => 'provider_name',
                4 => 'first_name',
             );
        
       $sql = "SELECT caseglnumber,no_gl, provider_name,first_name,group_name FROM [MP-12].mas.dbo.MAS_HELP_GL WHERE 1=1";
       

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
     
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( caseglnumber LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql.=" OR no_gl LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR provider_name LIKE '" . $requestData['search']['value'] . "%'";
            $sql.=" OR first_name LIKE '" . $requestData['search']['value'] . "%')";
            // $sql.=" OR province LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR city LIKE '" . $requestData['search']['value'] . "%'";
            // $sql.=" OR postal_code LIKE '" . $requestData['search']['value'] . "%')";          
        }
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
       
        $data = array();
        $i=1;
        
        foreach ($result as $key => $row)
        {
            $nestedData = array();
            $nestedData[] = $row["caseglnumber"];
            $nestedData[] = $row["no_gl"];
            $nestedData[] = $row["provider_name"];
            $nestedData[] = $row["first_name"];
            $nestedData[] = "<center><i class=\"addgl fas fa-plus\" aria-hidden=\"true\" data-id=\"".$row['caseglnumber'].';'.$row['provider_name'].';'.$row['first_name'].';'.$row['group_name']."\"></i></center>";
            $data[] = $nestedData;            
            $i++;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), 
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);
        
    }
    public function actionDatareferal(){

        //SO Pending -> SO & PR Pending
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT count(*) sopr 
                                           FROM referral_non_member_log 
                                           WHERE ((ISNULL(LTRIM(RTRIM(nomer_so)),'')='' ) OR (ISNULL(LTRIM(RTRIM(nomer_pr)),'')=''))
                                                  AND 
                                                  (
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>'')) AND  
                                                  ((ISNULL(LTRIM(RTRIM(no_gl)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(nama_rs)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(no_invoice)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>'')) 
                                                 )");                                      
        $modelsopr = $sql->queryOne();   


        //AR AP Pending -> AR & AP Pending
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT count(*) arap 
                                            FROM referral_non_member_log 
                                            WHERE ((ISNULL(LTRIM(RTRIM(nomer_so)),'')<>'' ) AND (ISNULL(LTRIM(RTRIM(nomer_pr)),'')<>''))
                                                    AND 
                                                    (
                                                    ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>'')) AND 
                                                    ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>'')) AND  
                                                    ((ISNULL(LTRIM(RTRIM(no_gl)),'')<>'')) AND 
                                                    ((ISNULL(LTRIM(RTRIM(nama_rs)),'')<>'')) AND 
                                                    ((ISNULL(LTRIM(RTRIM(no_invoice)),'')<>'')) AND  
                                                    ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''))
                                                    )
                                                    AND
                                                    (
                                                        ((ISNULL(LTRIM(RTRIM(tanggal_kirim_dokument_ar_ap)),'')=''))
                                                    )
                                                    ");                                      
        $modelarap = $sql->queryOne();   

        //AR Pending
        $sql = $connection->createCommand("SELECT count(*) ar 
                                           FROM referral_non_member_log 
                                           WHERE ((ISNULL(LTRIM(RTRIM(nomer_so)),'')<>''))
                                                 AND
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>'')) AND  
                                                  ((ISNULL(LTRIM(RTRIM(no_gl)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(nama_rs)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(no_invoice)),'')<>'')) AND
                                                  ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''))
                                                 AND
                                                 (
                                                  ((ISNULL(LTRIM(RTRIM(nomer_ar)),'')=''))
                                                 )");                                      
        $modelar = $sql->queryOne();

        //PO Pending
        $sql = $connection->createCommand("SELECT count(*) po
                                           FROM referral_non_member_log 
                                           WHERE ( 
                                                  ((ISNULL(LTRIM(RTRIM(nomer_pr)),'')<>''))
                                                  AND 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>'')) AND  
                                                  ((ISNULL(LTRIM(RTRIM(no_gl)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(nama_rs)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(no_invoice)),'')<>'')) AND
                                                  ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''))
                                                 AND
                                                  (
                                                    ((ISNULL(LTRIM(RTRIM(tanggal_kirim_dokument_ar_ap)),'')<>''))
                                                  )
                                                 AND
                                                 (
                                                  ((ISNULL(LTRIM(RTRIM(nomer_po)),'')=''))
                                                 )
                                                 )");                                      
        $modelpo = $sql->queryOne();   

        //AP Pending
        $sql = $connection->createCommand("SELECT count(*) ap 
                                           FROM referral_non_member_log 
                                           WHERE (
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')<>'')) AND  
                                                  ((ISNULL(LTRIM(RTRIM(no_gl)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(nama_rs)),'')<>'')) AND 
                                                  ((ISNULL(LTRIM(RTRIM(no_invoice)),'')<>'')) AND
                                                  ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')<>''))
                                                 AND
                                                  (
                                                    ((ISNULL(LTRIM(RTRIM(tanggal_kirim_dokument_ar_ap)),'')<>''))
                                                  )
                                                 AND
                                                 (
                                                    ((ISNULL(LTRIM(RTRIM(nomer_ap)),'')=''))
                                                 )
                                                 )");                                      
        $modelap= $sql->queryOne(); 
        
        //GL Document -> Document Pending
        $sql = $connection->createCommand("SELECT count(*) gl 
                                           FROM referral_non_member_log
                                           WHERE  ((ISNULL(LTRIM(RTRIM(tanggal_terima_berkas)),'')='')) OR 
                                                  ((ISNULL(LTRIM(RTRIM(tanggal_periksa)),'')='')) OR  
                                                  ((ISNULL(LTRIM(RTRIM(no_gl)),'')='')) OR
                                                  ((ISNULL(LTRIM(RTRIM(nama_rs)),'')='')) OR 
                                                  ((ISNULL(LTRIM(RTRIM(no_invoice)),'')='')) OR 
                                                  ((ISNULL(LTRIM(RTRIM(CONVERT(VARCHAR,document_file))),'')=''))
                                                ");                                     
        $modelgl= $sql->queryOne(); 

        //Transmission Pending
        $sql = $connection->createCommand("SELECT count(*) transmission FROM referral_transmission WHERE status = 0");                                      
        $modeltrans= $sql->queryOne(); 

        $data = [
            'status'=>'Success',
            'sopr'=>$modelsopr['sopr'],
            'arap'=>$modelarap['arap'],
            'ar'=>$modelar['ar'],
            'po'=>$modelpo['po'],
            'ap'=>$modelap['ap'],
            'gl'=>$modelgl['gl'],
            'transmission'=>$modeltrans['transmission'],


        ];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
    public function actionGetBisnisSelect(){ 
        $search = $_GET['q'];
       $sql = "SELECT * FROM [MP-8].KBM_LIVE.dbo.OCRD WHERE CardName like '%$search%' ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $datax = [
            'items'=> $data,
        ];
        return json_encode($datax);  
    }
    public function actionGetBisnis(){ 
        $name = $_POST['name'];
       $sql = "SELECT * FROM [MP-8].KBM_LIVE.dbo.OCRD WHERE CardName = '$name' ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data[0];
        
    }
    public function actionPostKirim(){ 
        if($_POST){
            $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
            srand((double)microtime()*1000000); 
            $i = 0; 
            $pass = '' ; 
        
            while ($i <= 7) { 
                $num = rand() % 33; 
                $tmp = substr($chars, $num, 1); 
                $pass = $pass . $tmp; 
                $i++; 
            } 

            // $hex = md5("yourSaltHere" . uniqid("", true));
            // $len=8;
            // $pack = pack('H*', $hex);
            // $tmp =  base64_encode($pack);
        
            // $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
        
            // $len = max(8, min(128, $len));
        
            // while (strlen($uid) < $len)
            // $uid .= gen_uuid(22);
        
        
            $input = new ModelKurirHead();
            $input->codekirim = $pass;
            $input->penerima = $_POST['penerima'];
            $input->nopenerima = $_POST['nopenerima'];
            $input->namabarang = $_POST['namabarang'];
            $input->alamat = $_POST['alamat'];
            $input->pengirim = $_POST['pengirim'];
            $input->nopengirim = $_POST['nopengirim'];
            $input->namapic = $_POST['pic'];
            $input->catatan = $_POST['catatan'];
            $input->status = 1;
            $input->created_at= date('Y-m-d H:i:s');
            $input->created_by = Yii::$app->user->identity->username;
            $input->save(false);
            $data = [
                'data'=>'success',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data; 
        }else{
            $data = [
                'data'=>'error',
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionPengiriman(){
        $hashids = new Hashids('12131213',10);

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'ItemCode',
                1 => 'ItemName',
             );
    
            
        
        $sql = "SELECT KURIR_HEAD.*,KURIR_STATUS.status opstatus FROM KURIR_HEAD 
        JOIN KURIR_STATUS ON KURIR_STATUS.id = KURIR_HEAD.STATUS
        where created_by = '".Yii::$app->user->identity->username."'";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
        
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( KURIR_HEAD.codekirim like '%" .$requestData['search']['value'] . "%' ";
            $sql.=" OR KURIR_HEAD.catatan LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.namabarang LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.penerima LIKE '%" . $requestData['search']['value'] . "%')";     
        }
        
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY id DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
            $residiterima = "";
            $delete ="";
            $url = Url::to(['kurir/cetak', 'id' =>$row['id']]);
            $idx = $row['id'];
            $cetak2 = Html::a('&nbsp&nbsp<span class="fas fa-qrcode">&nbsp&nbsp</span>', $url, ['title' => Yii::t('app', 'Print'),'target'=>'_blank']);
            $delivery = "<button type=\"button\" title='Tracking Data' onClick=\"gettracking($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-lg\">
            <span class=\"fas fa-truck\"></span>
            </button>";
            if($row["opstatus"] == "Manifested ( Mendaftarkan )"){
                $color = "warning";
            }elseif ($row["opstatus"] == "Cancel ( Di Batalkan )") {
                $color = "danger";
            }elseif ($row["opstatus"] == "Delivered ( Terkirim )") {
                $color = "success";
                $residiterima = "<button type=\"button\" title='Resi Di Terima Kembali' onClick=\"residiterimakembali($idx)\" class=\"btn btn-xs\">
                <span class=\"fas fa-check text-success\"></span>
                </button>";
            }else{
                $color = "info";
            }
            
            if($row["opstatus"] == "Manifested ( Mendaftarkan )"){
            $delete = "<button type=\"button\" title='Tracking Data' onClick=\"deletedata($idx)\" class=\"btn btn-xs\"><span class=\"fas fa-trash text-danger\"></span></button>";
            }
            
            $nestedData = array();
            $nestedData[] = $row["codekirim"];
            $nestedData[] = $row["penerima"];
            $nestedData[] = $row["namabarang"];
            $nestedData[] = $row["catatan"];
            $nestedData[] = "<small class=\"badge badge-".$color."\">".$row["opstatus"]."</small>";
            $nestedData[] = date("d-m-Y",strtotime($row["created_at"]));
            $nestedData[] = $residiterima.$cetak2.$delivery.$delete;
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
    public function actionAdminPengiriman(){
        $hashids = new Hashids('12131213',10);

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'ItemCode',
                1 => 'ItemName',
             );
    
            
        
        $sql = "SELECT KURIR_HEAD.*,KURIR_STATUS.status opstatus FROM KURIR_HEAD 
        JOIN KURIR_STATUS ON KURIR_STATUS.id = KURIR_HEAD.STATUS";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
        
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( KURIR_HEAD.codekirim like '%" .$requestData['search']['value'] . "%' ";
            $sql.=" OR KURIR_HEAD.catatan LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.namabarang LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.penerima LIKE '%" . $requestData['search']['value'] . "%')";     
        }
        
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY id DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
            $residiterima = "";
            $url = Url::to(['kurir/cetak', 'id' =>$row['id']]);
            $idx = $row['id'];
            $view = "<button type=\"button\" title='Edit Data' id='tracker' onClick=\"getdataedit($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-default\">
            <span class=\"fas fa-pen\"></span>
            </button>";
            $delivery = "<button type=\"button\" title='Tracking Data' onClick=\"gettracking($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-lg\">
            <span class=\"fas fa-truck\"></span>
            </button>";
            $cetak2 = Html::a('<span class="fas fa-qrcode"></span>', $url, ['title' => Yii::t('app', 'Print'),'class'=>'btn btn-xs','target'=>'_blank']);
            
            if($row["opstatus"] == "Manifested ( Mendaftarkan )"){
                $color = "warning";
            }elseif ($row["opstatus"] == "Cancel ( Di Batalkan )") {
                $color = "danger";
            }elseif ($row["opstatus"] == "Delivered ( Terkirim )") {
                $color = "success";
                $residiterima = "<button type=\"button\" title='Resi Di Terima Kembali' onClick=\"residiterimakembali($idx)\" class=\"btn btn-xs\">
                <span class=\"fas fa-check text-success\"></span>
                </button>";
            }else{
                $color = "info";
            }
            $nestedData = array();
            $nestedData[] = $row["codekirim"]."</br>Kurir:".$row["kurirnya"];
            $nestedData[] = $row["pengirim"];
            $nestedData[] = $row["penerima"];
            $nestedData[] = $row["namapic"];
            $nestedData[] = $row["namabarang"];
            $nestedData[] = $row["catatan"];
            $nestedData[] = $row["alamat"];
            $nestedData[] = "<small id='status".$idx."' class=\"badge badge-".$color."\">".$row["opstatus"]."</small>";
            $nestedData[] = date("d-m-Y",strtotime($row["created_at"]));
            $nestedData[] = $residiterima.$cetak2.$view.$delivery;
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

    public function actionKurirPengiriman(){
        $hashids = new Hashids('12131213',10);

        $requestData = $_REQUEST;        
        $columns = array(
                0 => 'ItemCode',
                1 => 'ItemName',
             );
    
            
        
        $sql = "SELECT KURIR_HEAD.*,KURIR_STATUS.status opstatus FROM KURIR_HEAD 
        JOIN KURIR_STATUS ON KURIR_STATUS.id = KURIR_HEAD.STATUS WHERE kurirnya = '".Yii::$app->user->identity->username."' ";
       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $totalData = count($data);
        $totalFiltered = $totalData;
        
        if (!empty($requestData['search']['value'])){
            $sql.=" AND ( KURIR_HEAD.codekirim like '%" .$requestData['search']['value'] . "%' ";
            $sql.=" OR KURIR_HEAD.catatan LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.namabarang LIKE '%" . $requestData['search']['value'] . "%'";
            $sql.=" OR KURIR_HEAD.penerima LIKE '%" . $requestData['search']['value'] . "%')";     
        }
        
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $totalFiltered = count($data);
       
        $sql.=" ORDER BY id DESC  OFFSET " . $requestData['start'] . "  " ." ROWS 
        FETCH NEXT " .$requestData['length'] .  " ROWS ONLY";  
       
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
    
        $data = array();
        
        
        foreach ($result as $key => $row){
           
          
            $url = Url::to(['kurir/cetak', 'id' =>$row['id']]);
            $idx = $row['id'];
            $view = "<button type=\"button\" title='Edit Data' id='tracker' onClick=\"getdataedit($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-default\">
            <span class=\"fas fa-pen\"></span>
            </button>";
            $delivery = "<button type=\"button\" title='Tracking Data' onClick=\"gettracking($idx)\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#modal-lg\">
            <span class=\"fas fa-truck\"></span>
            </button>";
            $cetak2 = Html::a('<span class="fas fa-qrcode"></span>', $url, ['title' => Yii::t('app', 'Print'),'class'=>'btn btn-xs','target'=>'_blank']);
            
            if($row["opstatus"] == "Manifested ( Mendaftarkan )"){
                $color = "warning";
            }elseif ($row["opstatus"] == "Cancel ( Di Batalkan )") {
                $color = "danger";
            }elseif ($row["opstatus"] == "Delivered ( Terkirim )") {
                $color = "success";
            }else{
                $color = "info";
            }
            $nestedData = array();
            $nestedData[] = $row["codekirim"]."</br>Kurir:".$row["kurirnya"];
            $nestedData[] = $row["pengirim"];
            $nestedData[] = $row["penerima"];
            $nestedData[] = $row["namapic"];
            $nestedData[] = $row["namabarang"];
            $nestedData[] = $row["catatan"];
            $nestedData[] = $row["alamat"];
            $nestedData[] = "<small class=\"badge badge-".$color."\">".$row["opstatus"]."</small>";
            $nestedData[] = date("d-m-Y",strtotime($row["created_at"]));
            // $nestedData[] = $cetak2.$view.$delivery;
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


    public function actionGetKurir(){
        if($_POST){
            $id = $_POST['id'];
            $connection = \Yii::$app->db;
            $kurir = $connection->createCommand("SELECT * FROM KURIR_HEAD WHERE id = '$id' ORDER BY id ASC ");
            $kurir = $kurir->queryOne();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $kurir;
        }
    }
    public function actionGetStatus(){ 
        $sql = "SELECT * FROM KURIR_STATUS ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
        
    }
    public function actionPostKurir(){ 
        if($_POST){
            $input = ModelKurirHead::findOne($_POST['idx']);        
            $input->penerima = $_POST['penerima'];
            $input->nopenerima = $_POST['nopenerima'];
            $input->namabarang = $_POST['namabarang'];
            $input->alamat = $_POST['alamat'];
            $input->pengirim = $_POST['pengirim'];
            $input->nopengirim = $_POST['nopengirim'];
            $input->namapic = $_POST['pic'];
            $input->catatan = $_POST['catatan'];
            $input->status = $_POST['status'];
            $input->kurirnya = $_POST['kuriruser'];
            $input->update_at= date('Y-m-d H:i:s');
            $input->cancelRemarks= $_POST['catatancancel'];
            $input->update_by = Yii::$app->user->identity->username;
            if($_POST['status'] == 2){
                $input->onprocess_by = $_POST['kuriruser'];
                $input->kurirnya = $_POST['kuriruser'];
                $input->onprocess_time = date('Y-m-d H:i:s');    
            }elseif($_POST['status'] == 3){
                $input->reschedule_by = $_POST['kuriruser'];
                $input->kurirnya = $_POST['kuriruser'];
                $input->reschedule_time = date('Y-m-d H:i:s');
            }elseif ($_POST['status'] == 4) {
                # code...
                $input->delivered_by = $_POST['kuriruser'];
                $input->kurirnya = $_POST['kuriruser'];
                $input->delivered_time = date('Y-m-d H:i:s');
            }elseif ($_POST['status'] == 5) {
                # code...
                $input->kurirnya = $_POST['kuriruser'];
                $input->cancel_by = $_POST['kuriruser'];
                $input->delivered_by = $_POST['kuriruser'];
                $input->cancel_time = date('Y-m-d H:i:s');
                $input->cancelRemarks = $_POST['catatancancel'];
            }
            $input->save(false);

            $detail = new ModelKurirDetail();
            $detail->head_id = $_POST['idx'];
            $detail->status = $_POST['status'];
            $detail->username = $_POST['kuriruser'];
            $detail->remarks = $_POST['remarks'].$_POST['catatancancel'];
            $detail->createdby = Yii::$app->user->identity->username;
            $detail->createdtime = date('Y-m-d H:i:s');
            $detail->save(false);

            $data = [
                'data'=>'success',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data; 
        }else{
            $data = [
                'data'=>'error',
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }

    }
    public function actionScanKurir(){
        $hashids = new Hashids('apixan',30);
        // var_dump($_POST);die;
        if($_POST){
            $id = $_POST['data'];
            $decode = $hashids->decode($id);
            $connection = \Yii::$app->db;
            $kurir = $connection->createCommand("SELECT * FROM KURIR_HEAD WHERE id = '$decode[0]' ORDER BY id ASC ");
            $kurir = $kurir->queryOne();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $kurir;

        }
    }

    public function actionGetHistKurir(){
        if($_POST){
            $id = $_POST['id'];
            $connection = \Yii::$app->db;
            $kurir = $connection->createCommand("SELECT a.*,b.status descx FROM KURIR_DETAIL a JOIN KURIR_STATUS b ON b.id = a.status WHERE head_id = $id ORDER BY a.id DESC ");
            $kurir = $kurir->queryAll();
            $codex ="";
            $timebefore="";
            foreach ($kurir as $key => $value) {
                $remarks = $value['remarks'];
                $username = $value['username'];
                $status = $value['descx'];
                $photo = $value['photo'];
                $time = date("j F, Y, g:i a", strtotime($value['createdtime']));
                $timex = date("g:i a", strtotime($value['createdtime']));
                $image = (!empty($photo)? Html::a(Html::img('upload/kurir/' . $photo, ['alt' => 'pic2', 'class' => 'img-fluid']), [ 'upload/kurir/' . $photo], ['target'=>'_blank']):'');
                $codex .="<li><span></span>
                <div>
                    <div class=\"title\">$username</div>
                    <div class=\"info\">$remarks.'</br>'.$image</div>
                    <div class=\"type\">$status</div>
                    <div class=\"time\">$time</div>
                </div><span class=\"number\"><span>$timex</span><span></span></span>
            </li>";
            $timebefore = $timex;
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $codex;
        }
    }
    public function actionGetFileRef(){
        $datax = "";
        $option = "";
        $option2 = "";
        if($_POST){
            $id = $_POST['id'];
            $sql = "SELECT * FROM REFERRAL_NON_MEMBER_LOG WHERE id = $id ";
            $datax = Yii::$app->db->createCommand($sql)->queryOne();
            // var_dump($datax['document_file']);die;
            $array = explode(";",$datax['document_file']);
            $array2 = explode(";",$datax['gl_file']);

            $option .= "
            <table class=\"table\">
            <thead>
                <tr>
                <th scope=\"col\">Name File</th>
                <th scope=\"col\">Action</th>
                </tr>
            </thead>
            <tbody>";


            foreach ($array as $key => $value) {
                if(!empty($value)){
                    $option .= "<tr>
                    <td>$value</td>
                    <td>".Html::a('<i class="fas fa-download"></i>', ['referral-non-member/download-reff-document','name' => $value,], ['class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',]). 
                    Html::a('<i class="fas fa-share"></i>', ['referral-non-member/download-reff-document-new-tab','name' => $value,], ['title'=>'Open New Tab','class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',]).
                    "<button type=\"button\" class=\"btn btn-xs btn-outline-primary  mr-2\" id='pdfobject' data-id='$value' data-jenis='docref' data-toggle=\"modal\" data-target=\"#modal-lg\"><i class='fas fa-eye'></i></button>".
                    "<button type=\"button\" onclick=\"return confirm('Are you sure you want to delete this item?');\" class=\"btn btn-xs btn-outline-primary\" id='deletefiles' data-id='$id' data-value='$value' ><i class='fas fa-trash'></i></button>"."</td>
                    </tr>";
                }
            }
            $option .= "</tbody>
            </table>";

            $option2 .= "
            <table class=\"table\">
            <thead>
                <tr>
                <th scope=\"col\">Name File</th>
                <th scope=\"col\">Action</th>
                </tr>
            </thead>
            <tbody>";


            foreach ($array2 as $key => $value) {
                if(!empty($value)){
                    $option2 .= "<tr>
                    <td>$value</td>
                    <td>".Html::a('<i class="fas fa-download"></i>', ['referral-non-member/download-reff-so','name' => $value,], ['class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',]). 
                    Html::a('<i class="fas fa-share"></i>', ['referral-non-member/download-reff-so-new-tab','name' => $value,], ['title'=>'Open New Tab','class' => 'btn btn-outline-primary btn-xs mr-2','target' => '_blank',]).
                    "<button type=\"button\" class=\"btn btn-xs btn-outline-primary\" id='pdfobject' data-id='$value' data-jenis='soref' data-toggle=\"modal\" data-target=\"#modal-lg\"><i class='fas fa-eye'></i></button>".
                    "<button type=\"button\" onclick=\"return confirm('Are you sure you want to delete this item?');\" class=\"btn btn-xs btn-outline-primary\" id='deletegl' data-id='$id' data-value='$value' ><i class='fas fa-trash'></i></button>"."</td>
                    </tr>";
                }
            }
            $option2 .= "</tbody>
            </table>";
            $data = [
                'documentfile'=> $option,
                'gl_file'=> $option2,
                'status'=> 'Success'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    public function actionDeleteFileReff(){
        if($_POST){
            $id = $_POST['id'];
            $name = $_POST['name']; 

            $model = ModelReferralNonMemberLog::findOne($id);
            $newfile = $this->removeFromString($model->document_file, $name);
            $model->document_file = $newfile;
            $model->save(false);
            $data = [
                'data'=>'success',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        } else {
            $data = [
                'data'=>'failed',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data; 
        }
    }
    public function actionDeleteFileglReff(){
        if($_POST){
            $id = $_POST['id'];
            $name = $_POST['name']; 

            $model = ModelReferralNonMemberLog::findOne($id);
            $newfile = $this->removeFromString($model->gl_file, $name);
            $model->gl_file = $newfile;
            $model->save(false);
            $data = [
                'data'=>'success',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        } else {
            $data = [
                'data'=>'failed',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data; 
        }
    }
    function removeFromString($str, $item) {
        $parts = explode(';', $str);
    
        while(($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }
    
        return implode(';', $parts);
    }
    public function actionScanAlkes(){
        $hashids = new Hashids('apixan',30);
        // var_dump($_POST);die;
        if($_POST){
            $id = $_POST['data'];
            $decode = $hashids->decode($id);
            $connection = \Yii::$app->db;
            $alkes = $connection->createCommand("select [codeAset]
            ,a.noAsset_SAP
            ,a.noInventory
            ,a.namaAlat
            ,a.merk
            ,a.tipe
            ,a.noSeri
            ,a.lokasi
            ,FORMAT(a.tglBeli,'dd/MM/yyyy, hh:mm:ss ') tglBeli
            ,a.kondisi
            ,FORMAT(a.tglKalibrasi,'dd/MM/yyyy') tglKalibrasi
            ,FORMAT(a.tglexpKalibrasi,'dd/MM/yyyy') tglexpKalibrasi
            ,(SELECT TOP 1 nosr FROM  WH_ASSET_ALKES_MAINTENANCE WHERE codeAsset = a.codeAset ORDER BY id DESC ) Nodocument
            ,(SELECT TOP 1 actionplan FROM  WH_ASSET_ALKES_MAINTENANCE WHERE codeAsset = a.codeAset ORDER BY id DESC) action_plan
            ,(SELECT TOP 1 StatusBarang FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) StatusBarang
            ,(SELECT TOP 1 noInvTrans FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) noInvTrans
            ,(SELECT TOP 1 FORMAT(tgl_pengiriman,'dd/MM/yyyy, hh:mm:ss ') FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_pengiriman
            ,(SELECT TOP 1 FORMAT(tgl_penerimaan,'dd/MM/yyyy, hh:mm:ss ') FROM  WH_ASSET_ALKES_TRACKING WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_penerimaan
            -- ,(SELECT TOP 1 FORMAT(tgl_kalibrasi,'dd/MM/yyyy, hh:mm:ss ') FROM  WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_kalibrasi
            -- ,(SELECT TOP 1 FORMAT(tgl_endkalibrasi,'dd/MM/yyyy, hh:mm:ss ') FROM  WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = a.codeAset ORDER BY id DESC) tgl_endkalibrasi
            ,(SELECT TOP 1 filesertifikat FROM  WH_ASSET_ALKES_CALIBRATION WHERE codeAsset = a.codeAset ORDER BY id DESC) filesert
            ,(SELECT TOP 1 sparepart FROM  WH_ASSET_ALKES_REPAIR WHERE codeAsset = a.codeAset ORDER BY id DESC) sparepart
            ,(SELECT Stuff((SELECT N', ' + CAST(acessories AS varchar(4000)) FROM WH_ASSET_ALKES_ACESSORIES WHERE codeAsset = a.codeAset  FOR XML PATH(''),TYPE).value('text()[1]','nvarchar(max)'),1,2,N'')) acessories FROM WH_ASSET_ALKES a where codeAset = '$id'");
            $alkes = $alkes->queryOne();
            $hasil = 'Code Aset : ' .$alkes['codeAset'] . ' </br>No Asset SAP : ' .$alkes['noAsset_SAP'] .
            '</br>Nama Alat : ' .$alkes['namaAlat'] . '</br>Merek : ' .$alkes['merk'] . '</br>Tipe : ' .$alkes['tipe'] .
            '</br>No Seri : ' .$alkes['noSeri'] . '</br>Lokasi : ' .$alkes['lokasi'] . '</br>Tanggal Beli : ' .$alkes['tglBeli'] .
            '</br>Kondisi : ' .$alkes['kondisi'] . '</br>No Document : ' .$alkes['Nodocument'] . '</br>Action Plan : ' .$alkes['action_plan'] .
            '</br>Status Barang : ' .$alkes['StatusBarang'] . '</br>No Ivn Transfer : ' .$alkes['noInvTrans'] .
            '</br>Tanggal Pengiriman : ' .$alkes['tgl_pengiriman'] . '</br>Tanggal Penerimaan : ' .$alkes['tgl_penerimaan'] .
            '</br>Tanggal Kalibrasi : ' .$alkes['tglKalibrasi'] . '</br>Tanggal Berkahir : ' .$alkes['tglexpKalibrasi'] .
            '</br>Sparepart : ' .$alkes['sparepart'] . '</br>Accessories :</br>' .$alkes['acessories']. '</br>File Sertifikat :</br> <a href=\'/upload/alkeswh/'. $alkes['filesert'] .'\' download>Download File</a>';

            Yii::$app->response->format = Response::FORMAT_JSON;
            return $hasil;

        }
    }
    public function actionResikembali(){
        // $hashids = new Hashids('apixan',30);
        if($_POST){
            $model = ModelKurirHead::findOne(['id' => $_POST['id']]);
            $model->status = 6;
            $model->resiback = Yii::$app->user->identity->username;
            $model->resiback_time = date('Y-m-d H:i:s');    
            $model->save(false);
            $data = [
                'data'=>'success',
                ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data; 

        }
    }
}
?>