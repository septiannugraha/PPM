<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefPegawai */
?>
<div class="ref-pegawai-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'nip',
            'pangkat',
            'gol',
            'ruang',
            'jabatan',
            'satker',
            'bidang_id',
            'subbidang_id',
            'karpeg',
            'sex',
            'agama',
            'tmt',
            'peran',
            'reg_ak',
            'pendidikan_p',
            'pendidikan',
            'stat',
            'tgl_lahir',
        ],
    ]) ?>

</div>
