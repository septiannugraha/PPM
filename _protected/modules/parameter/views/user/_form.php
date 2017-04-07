<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthItem;
use kartik\password\PasswordInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
            echo $form->field($model, 'group_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\Groups::find()->all(),'id','name'),
                'options' => ['placeholder' => 'Pilih Peran ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php if ($model->scenario === 'create'): ?>

        <?= $form->field($model, 'password')->widget(PasswordInput::classname(), 
            ['options' => ['placeholder' => Yii::t('app', 'Create password')]]) ?>

    <?php else: ?>

        <?= $form->field($model, 'password')->widget(PasswordInput::classname(),
                    ['options' => ['placeholder' => Yii::t('app', 'Biarkan kosong jika tetap')]]) ?> 

    <?php endif ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php 
            echo $form->field($model, 'kode_unit')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\RefUnitOrganisasi::find()->all(),'kode_unit','nama_unit'),
                'options' => ['placeholder' => 'Pilih Unit Organisasi ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
    ?>    
    <div class="row">
        <i class="pull-left">Bagian berikut diisi dengan status active dan role sebagai member, kecuali administrator</i>
    </div>

    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>
        </div>
        <div class="col-md-6">
            <?php foreach (AuthItem::getRoles() as $item_name): ?>
                <?php $roles[$item_name->name] = $item_name->name ?>
            <?php endforeach ?>
            <?= $form->field($model, 'item_name')->dropDownList($roles) ?>

        </div>
    </div>    
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
