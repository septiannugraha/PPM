<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefPegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pangkat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satker')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bidang_id')->textInput() ?>

    <?= $form->field($model, 'subbidang_id')->textInput() ?>

    <?= $form->field($model, 'karpeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmt')->textInput() ?>

    <?= $form->field($model, 'peran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_ak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikan_p')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
