<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'peran.name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'pegawai.s_nama_lengkap',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'keterangan',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{delete}',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'delete' => function($url, $model){
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/transaksi/peserta/delete', 'id' => $model->id],
                                [  
                                    'title' => Yii::t('yii', 'ubah'),
                                    // 'data-toggle'=>"modal",
                                    // 'data-target'=>"#myModalubah",
                                    // 'data-title'=> "Ubah SPJ ".$model->no_spj,                                 
                                    'data-confirm' => "Yakin menghapus peserta ini?",
                                    'data-method' => 'POST',
                                    'data-pjax' => 1
                                ]);
            }
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   