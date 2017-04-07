<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\TaProgram;
use app\models\Laporan;
use app\models\Ppud;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\controlhutang\models\TaRASKArsipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="row col-md-12">
    <div class="col-md-4">
        <?php

            $model->Kd_Laporan = isset(Yii::$app->request->queryParams['Laporan']['Kd_Laporan']) ? Yii::$app->request->queryParams['Laporan']['Kd_Laporan'] : '';
            echo $form->field($model, 'Kd_Laporan')->widget(Select2::classname(), [
                'data' => [
                    '1' => 'Laporan Individu',
                    '2' => 'Rekapitulasi Pelaksanaan PPM',               
                ],
                'options' => ['class' =>'form-control input-sm' ,'placeholder' => 'Pilih Jenis Laporan ...', 
                // 'onchange'=> 'this.form.submit()'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
        ?>
    </div>
    <div class="col-md-3">
        <?php
            if(isset(Yii::$app->request->queryParams['Laporan']['kode_pegawai'])) $model->kode_pegawai = Yii::$app->request->queryParams['Laporan']['kode_pegawai'];
            $queryData = \app\models\Pegawai::find();
            if(Yii::$app->user->identity->kode_unit){
                $queryData->where(['s_kd_instansiunitorg' => Yii::$app->user->identity->kode_unit]);
            }
            $queryData = $queryData->all();
            // $dataSumber = ArrayHelper::map(\app\models\Pegawai::find()->where(['unit' => 1])->all(), 'kode', 'uraian');
            echo $form->field($model, 'kode_pegawai')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map($queryData,'niplama','namaNip'),
                'options' => ['class' =>'form-control input-sm' ,'placeholder' => 'Pilih Pegawai ...', 
                // 'onchange'=> 'this.form.submit()'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
        ?>
    </div>
    <div class="col-md-3">
        <?php
            if(isset(Yii::$app->request->queryParams['Laporan']['Tgl_1'])){
                $model->Tgl_1 = Yii::$app->request->queryParams['Laporan']['Tgl_1'];
                $model->Tgl_2 = Yii::$app->request->queryParams['Laporan']['Tgl_2'];                
            }ELSE{
                $model->Tgl_1 = $Tahun.'-01-01';
                $model->Tgl_2 = $Tahun.'-12-31';
            }

            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'Tgl_1',
                'attribute2' => 'Tgl_2',
                'type' => DatePicker::TYPE_RANGE,
                'options' => ['placeholder' => 'Mulai'],
                'options2' => ['placeholder' => 'Sampai'],                
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ],
                // 'readonly' => true,
                'layout' => '{input1}{separator}{input2}',
            ]);               
        ?>    
    </div>
    <div class="col-md-2">
        <?php
            if(isset(Yii::$app->request->queryParams['Laporan']['Tgl_Laporan'])){
                $model->Tgl_Laporan = Yii::$app->request->queryParams['Laporan']['Tgl_Laporan'];             
            }ELSE{
                $model->Tgl_Laporan = $Tahun.'-12-31';
            }

            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'Tgl_Laporan',
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Tanggal Laporan'],              
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]);               
        ?>    
    </div>    
</div>
<div class="row col-md-12"> 
    <div class="col-md-2">
        <?php
        $getparam = Yii::$app->request->queryParams;
        if(isset($getparam['Laporan']['kota_ttd'])) $model->kota_ttd = $getparam['Laporan']['kota_ttd']; ?>
        <?= $form->field($model, 'kota_ttd')->textInput(['maxlength' => true, 'placeholder' => 'Kota'])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?php if(isset($getparam['Laporan']['jabatan_ttd'])) $model->jabatan_ttd = $getparam['Laporan']['jabatan_ttd']; ?>
        <?= $form->field($model, 'jabatan_ttd')->textInput(['maxlength' => true, 'placeholder' => 'Jabatan'])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?php if(isset($getparam['Laporan']['nama_ttd'])) $model->nama_ttd = $getparam['Laporan']['nama_ttd']; ?>
        <?= $form->field($model, 'nama_ttd')->textInput(['maxlength' => true, 'placeholder' => 'Nama'])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?php if(isset($getparam['Laporan']['nip_ttd'])) $model->nip_ttd = $getparam['Laporan']['nip_ttd']; ?>
        <?= $form->field($model, 'nip_ttd')->textInput(['maxlength' => true, 'placeholder' => 'NIP'])->label(false) ?>
    </div>
    <div class="col-md-2 pull-right">
        <?= Html::submitButton( 'Pilih', ['class' => 'btn btn-default']) ?>        
    </div>
</div>

    <?php ActiveForm::end(); ?>
