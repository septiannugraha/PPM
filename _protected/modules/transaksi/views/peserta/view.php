<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tpeserta */
?>
<div class="tpeserta-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ppm_id',
            'pegawai_id',
            'peran_id',
            'keterangan',
        ],
    ]) ?>

</div>
