<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefCategory */
?>
<div class="ref-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bidang_id',
            'no_urut',
            'name',
        ],
    ]) ?>

</div>
