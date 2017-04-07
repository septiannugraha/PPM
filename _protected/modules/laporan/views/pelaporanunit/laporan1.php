<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use xj\bootbox\BootboxAsset;
use yii\bootstrap\Modal;
use yii\web\Controller;
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php 
    echo GridView::widget([
        'dataProvider' => $data,
        //'filterModel' => $searchModel,
        // 'export' => true, 
        'responsive'=>true,
        'hover'=>true,     
        'resizableColumns'=>false,
        'panel'=>['type'=>'primary', 'heading'=> $heading       
        ],
        'responsiveWrap' => false,        
        'toolbar' => [
            '{toggleData}',
            '{export}',
            [
                'content' =>    Html::a('<i class="glyphicon glyphicon-print"></i> Cetak', ['cetak', 'Laporan' => [
                                    'Kd_Laporan' => $getparam['Laporan']['Kd_Laporan'], 
                                    'kode_pegawai' => $getparam['Laporan']['kode_pegawai'],
                                    'Tgl_1' => $getparam['Laporan']['Tgl_1'],
                                    'Tgl_2' => $getparam['Laporan']['Tgl_2'],
                                    'Tgl_Laporan' => $getparam['Laporan']['Tgl_Laporan'],
                                    'kota_ttd' => $getparam['Laporan']['kota_ttd'],
                                    'jabatan_ttd' => $getparam['Laporan']['jabatan_ttd'],
                                    'nama_ttd' => $getparam['Laporan']['nama_ttd'],
                                    'nip_ttd' => $getparam['Laporan']['nip_ttd'],
                                ] ], [
                                    'class' => 'btn btn btn-default pull-right',
                                    'onClick' => "return !window.open(this.href, 'SPH', 'width=1024,height=600,scrollbars=1')"
                                        ]) 
            ],
        ],       
        'pager' => [
            'firstPageLabel' => 'Awal',
            'lastPageLabel'  => 'Akhir'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'laporan1-pjax', 'timeout' => 5000],
        ],
        'showPageSummary'=>true,         
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',],
            'ppm.no',
            'ppm.tetap_tanggal:date',
            'ppm.tentang',
            [
                'label' => 'Peran',
                'attribute' => 'peran.name',
            ],
            [
                'label' => 'Angka Kredit',
                'format' => 'decimal',
                'pageSummary' => true,
                'value' => function($model){
                    return $model->peran->bobot_kredit;
                },
            ]
        ],
    ]); 
?>
