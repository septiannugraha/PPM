<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ppud */
?>
<div class="ppud-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'puud',
            'puuddetail',
            'no',
            'tahun',
            'tentang',
            'tag',
            'files',
            'tetap_province',
            'tetap_kabkot',
            'tetap_tanggal',
            'user_id',
            'created',
            'updated',
        ],
    ]) ?>

    <?php 
    $ext = explode(".", $model->files);
    $ext = end($ext);
    IF($ext == 'pdf' || $ext == 'PDF'){
        echo \yii2assets\pdfjs\PdfJs::widget([
            'url' => str_replace(' ', '%20',Yii::$app->params['accessibleStaticContentUrl'].$model->puud.'/'.$model->files),
            // 'url' => 'http://www.pdf995.com/samples/pdf.pdf',
            'width' => '100%',
            'height' => '800px',
        ]);
    }ELSEIF(in_array($ext, ['jpg', 'gif', 'png'])){
        echo Html::img(Yii::$app->params['accessibleStaticContentUrl'].$model->puud.'/'.$model->files, [
            'class'=>'img-thumbnail', 
            'alt'=> $model->tentang, 
            'title'=> $model->tentang,
        ]);
    }ELSE{
        echo Html::a('<i class="glyphicon glyphicon-download"></i> Download', Yii::$app->params['accessibleStaticContentUrl'].$model->puud.'/'.$model->files, [
            'class' => 'btn btn-lg btn-success',
        ]);
    }
    ?>
</div>
