<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Tpeserta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpeserta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
            echo $form->field($model, 'peran_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\RperanPpm::find()->all(),'id','name'),
                'options' => ['placeholder' => 'Pilih Peran ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>    

    <?php 
            $queryData = \app\models\Pegawai::find();
            if(Yii::$app->user->identity->kode_unit){
                $queryData->where(['s_kd_instansiunitorg' => Yii::$app->user->identity->kode_unit]);
            }
            $queryData = $queryData->all();
            echo $form->field($model, 'pegawai_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($queryData,'niplama','namaNip'),
                'options' => ['placeholder' => 'Pilih Pegawai ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>   

    <?= $form->field($model, 'keterangan')->textArea() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
