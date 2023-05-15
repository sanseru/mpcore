<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    // public $sourcePath = '@bower/adminlte/';

    public $css = [
        'adminlte/plugins/fontawesome-free/css/all.min.css',
        'adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'adminlte/plugins/jqvmap/jqvmap.min.css',
        'adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'adminlte/plugins/daterangepicker/daterangepicker.css',
        'adminlte/plugins/summernote/summernote-bs4.css',
        'adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css',
        'adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
        'adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'adminlte/dist/css/adminlte.min.css',
        'adminlte/plugins/select2/css/select2.min.css',
        'adminlte/plugins/daterangepicker/daterangepicker.css',
        'https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css',


 
        ];
    public $js = [
        'adminlte/plugins/jquery-ui/jquery-ui.min.js',
        'adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'adminlte/plugins/chart.js/Chart.min.js',
        'adminlte/plugins/sparklines/sparkline.js',
        'adminlte/plugins/jquery-knob/jquery.knob.min.js',
        'adminlte/plugins/moment/moment.min.js',
        'adminlte/plugins/daterangepicker/daterangepicker.js',
        'adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'adminlte/plugins/summernote/summernote-bs4.min.js',
        'adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
        'adminlte/dist/js/adminlte.js',
        'adminlte/plugins/datatables/jquery.dataTables.js',
        'adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js',
        'adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js',
        'adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
        'adminlte/plugins/sweetalert2/sweetalert2.min.js',
        'adminlte/plugins/select2/js/select2.min.js',
        'adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js',
        'inc/apiTable.js',
        'inc/html5-qrcode.min.js',
        'https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js',
        'https://unpkg.com/pdfobject@2.2.7/pdfobject.min.js',



    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        // 'frontend\assets\CustomAsset',
        'rmrevin\yii\fontawesome\NpmFreeAssetBundle',
    ];
}