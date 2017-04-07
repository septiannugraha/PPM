<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tahun',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tetap_tanggal',
        'format' => 'date',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tentang',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tag',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'files',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tetap_province',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tetap_kabkot',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'noWrap' => true,
        'template' => '{peserta} {view} {update} {delete}',
        'buttons' => [
            'peserta' => function ($url, $model) {
                return Html::a('<i class="glyphicon glyphicon-user"></i> Peserta', $url,
                    [  
                        'title' => Yii::t('yii', 'Daftar Peserta'),
                        'class'=>"btn btn-xs btn-default",                                 
                        // 'data-confirm' => "Yakin menghapus sasaran ini?",
                        // 'data-method' => 'POST',
                        'data-pjax' => 0
                    ]);
            },
        ],
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
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