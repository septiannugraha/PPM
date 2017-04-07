<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefUnitOrganisasi */
?>
<div class="ref-unit-organisasi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_unit',
            'nama_unit',
        ],
    ]) ?>

</div>
