<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ppud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppud-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-6">
        <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'tetap_tanggal')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Select date ...'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose'=>true
            ]
        ]) ?>
    </div>

    <?php 
            echo $form->field($model, 'puud')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\Puus::find()->all(),'id','name'),
                'options' => ['placeholder' => 'Pilih Kategori PPM ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>    

    <?= $form->field($model, 'no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tentang')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload')->fileInput() ?>     
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
