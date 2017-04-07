<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RperanPpm */
?>
<div class="rperan-ppm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'bobot_kredit',
        ],
    ]) ?>

</div>
