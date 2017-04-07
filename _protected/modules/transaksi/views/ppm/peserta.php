<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use kartik\detail\DetailView;
use dosamigos\multiselect\MultiSelect;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\helpers\Url;

$this->title = 'Peserta PPM No '.$model->no;
$this->params['breadcrumbs'][] = 'Transaksi';
$this->params['breadcrumbs'][] = ['label' => 'PPM', 'url' => ['/transaksi/ppm']];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<?=
    DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'enableEditMode' => true,
        'hideIfEmpty' => false, //sembunyikan row ketika kosong
        'panel'=>[
            'heading'=>'<i class="fa fa-tag"></i> '.$model->no.'</h3>',
            'type'=>'primary',
            'headingOptions' => [
                'tag' => 'h3', //tag untuk heading
            ],
        ],
        'buttons1' => '{update}', // tombol mode default, default '{update} {delete}'
        'buttons2' => '{save} {view}', // tombol mode kedua, default '{view} {reset} {save}'
        'viewOptions' => [
            'label' => '<span class="glyphicon glyphicon-remove-circle"></span>',
        ],      
        'attributes' => [
            'no',
            'tetap_tanggal:date',
            'tentang:ntext',
        ],
    ])
?>
<div class="tpeserta-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/../peserta/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/transaksi/peserta/tambah', 'id' => $model->id],
                    ['role'=>'modal-remote','title'=> 'Tambah Peserta','class'=>'btn btn-default']).
                    // Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    // ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Daftar Peserta',
                'before'=>'<em>* Berikut daftar peserta PPM ini.</em>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'size' => 'modal-lg',
    "footer"=>"",// always need it for jquery plugin
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],    
])?>
<?php Modal::end(); ?>
