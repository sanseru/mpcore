<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=> 'Medika Plaza Core System',
    'timeZone' => 'Asia/Jakarta',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => true, //tambahan
            'authTimeout' => 21600, //30 minutes tambahan untuk session
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'class' => 'yii\web\Session', //tambahan session
            'name' => 'advanced-frontend',
            'timeout' => 21600,

        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['pattern' => 'login','route' => 'site/login','suffix' => '',],

                ['pattern' => 'menu','route' => 'menu/index','suffix' => '.mp',],
                ['pattern' => 'menucreate','route' => 'menu/create','suffix' => '.mp',],
                ['pattern' => 'submenu','route' => 'menu/submenu','suffix' => '',],

                ['pattern' => 'ViewInv','route' => 'inv-track-head/view','suffix' => '.mp',],
                ['pattern' => 'approved','route' => 'inv-track-head/process-approve','suffix' => '.mp',],
                ['pattern' => 'uploadinvoice','route' => 'inv-track-head/uploadinvoice','suffix' => '.mp',],
                ['pattern' => 'updateinv','route' => 'inv-track-head/update','suffix' => '.mp',],
                ['pattern' => 'createinv','route' => 'inv-track-head/create','suffix' => '.mp',],
                ['pattern' => 'reportinv','route' => 'inv-track-head/report','suffix' => '.mp',],
                ['pattern' => 'assetnyagani','route' => 'asset/index','suffix' => '.gani',],
                ['pattern' => 'serahterima','route' => 'serah-terima','suffix' => '.gani',],
                ['pattern' => 'formcreate','route' => 'serah-terima/create','suffix' => '.gani',],
                ['pattern' => 'formupdateasset','route' => 'serah-terima/update','suffix' => '.gani',],
                ['pattern' => 'assetview','route' => 'serah-terima/view','suffix' => '.gani',],
                ['pattern' => 'itemcode','route' => 'asset/itemcode','suffix' => '.wh',],
                ['pattern' => 'itemcodesearch','route' => 'asset/itemcodesearch','suffix' => '.wh',],
                ['pattern' => 'batchinginv','route' => 'inv-track-head/batchingview','suffix' => '',],
                ['pattern' => 'stockopname','route' => 'whstophead/index','suffix' => '.wh',],
                ['pattern' => 'opnameview','route' => 'whstophead/view','suffix' => '.wh',],
                ['pattern' => 'opnamecreate','route' => 'whstophead/create','suffix' => '.wh',],
                ['pattern' => 'opnameupdate','route' => 'whstophead/update','suffix' => '.wh',],
                ['pattern' => 'opnameinput','route' => 'whstophead/opname','suffix' => '.wh',],
                ['pattern' => 'gudang','route' => 'whgudang/index','suffix' => '.wh',],
                ['pattern' => 'gudangview','route' => 'whgudang/view','suffix' => '.wh',],
                ['pattern' => 'assetalkes','route' => 'wh-asset-alkes','suffix' => '.wh',],
                ['pattern' => 'alkesview','route' => 'wh-asset-alkes/view','suffix' => '.wh',],
                ['pattern' => 'alkescreate','route' => 'wh-asset-alkes/create','suffix' => '.wh',],
                ['pattern' => 'alkesupdate','route' => 'wh-asset-alkes/update','suffix' => '.wh',],
                ['pattern' => 'alkesuser','route' => 'wh-asset-alkes/index-user','suffix' => '.wh',],
                ['pattern' => 'alkesuserview','route' => 'wh-asset-alkes/view-user','suffix' => '.wh',],
                ['pattern' => 'alkescancode','route' => 'wh-asset-alkes/scan-barcode-alkes','suffix' => '.wh',],




                ['pattern' => 'providerrebate','route' => 'mas-provider-rebate/index','suffix' => '.mas',],
                ['pattern' => 'providercreate','route' => 'mas-provider-rebate/create','suffix' => '.mas',],
                ['pattern' => 'uploadatamas','route' => 'rebate/index','suffix' => '.mas',],
                ['pattern' => 'rebate','route' => 'rebate/countrebate','suffix' => '.mas',],
                ['pattern' => 'rebatedetail','route' => 'rebate/detailupload','suffix' => '.mas',],
                ['pattern' => 'scanbarcode','route' => 'kurir','suffix' => '.ga',],

                ['pattern' => 'refnondata','route' => 'referral-non-member/index','suffix' => '.app',],
                ['pattern' => 'refnonview','route' => 'referral-non-member/view','suffix' => '.app',],
                ['pattern' => 'refnoncreate','route' => 'referral-non-member/create','suffix' => '.app',],
                ['pattern' => 'refnonupdate','route' => 'referral-non-member/update','suffix' => '.app',],
                ['pattern' => 'refnonso','route' => 'referral-non-member/so','suffix' => '.app',],
                ['pattern' => 'refnonar','route' => 'referral-non-member/ar','suffix' => '.app',],
                ['pattern' => 'refnonap','route' => 'referral-non-member/ap','suffix' => '.app',],
                ['pattern' => 'refnonpo','route' => 'referral-non-member/po','suffix' => '.app',],
                ['pattern' => 'refnonsoprpending','route' => 'referral-non-member/soprpending','suffix' => '.app',],
                ['pattern' => 'refnonarpending','route' => 'referral-non-member/arpending','suffix' => '.app',],
                ['pattern' => 'refnonarappending','route' => 'referral-non-member/arappending','suffix' => '.app',],
                ['pattern' => 'refnonappending','route' => 'referral-non-member/appending','suffix' => '.app',],
                ['pattern' => 'refnonpopending','route' => 'referral-non-member/popending','suffix' => '.app',],
                ['pattern' => 'refreport','route' => 'referral-non-member/report','suffix' => '.app',],
                ['pattern' => 'refnontransmission','route' => 'referral-non-member/transmission','suffix' => '.app',],


                ['pattern' => 'reftrans','route' => 'referral-transmission/index','suffix' => '.app',],
                ['pattern' => 'reftransview','route' => 'referral-transmission/view','suffix' => '.app',],
                ['pattern' => 'reftranscreate','route' => 'referral-transmission/create','suffix' => '.app',],
                ['pattern' => 'reftransupdate','route' => 'referral-transmission/update','suffix' => '.app',],

                ['pattern' => 'kurir','route' => 'kurir/index','suffix' => '.ga',],
                ['pattern' => 'kuriradmin','route' => 'kurir/admin','suffix' => '.ga',],
                ['pattern' => 'kurirview','route' => 'kurir/kurirview','suffix' => '.ga',],
                ['pattern' => 'financekurirview','route' => 'kurir/finance','suffix' => '.finance',],


                ['pattern' => 'kurirscan','route' => 'kurir/scanbarcode','suffix' => '.ga',],
                ['pattern' => 'pdfdownload','route' => 'kurir/downloadupload','suffix' => '.ga',],

                ['pattern' => 'pr','route' => 'purchase-request-head/index','suffix' => '.finance',],
                ['pattern' => 'prcreate','route' => 'purchase-request-head/create','suffix' => '.finance',],






            ],
        ],
        
    ],
    'params' => $params,
    // Setting Global harus Login
    // 'as beforeRequest' => [
    //     'class' => 'yii\filters\AccessControl',
    //     'rules' => [
    //         [
    //             'allow' => true,
    //             'actions' => ['login','api'],
    //             'roles' => ['?'],

    //         ],
    //         [
    //             'allow' => true,
    //             'roles' => ['@'],
    //         ],
    //     ],
    //     'denyCallback' => function () {
    //         return Yii::$app->response->redirect(['site/login']);
    //     },
    // ],
];


