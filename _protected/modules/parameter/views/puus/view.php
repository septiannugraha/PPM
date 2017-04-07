<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Puus */
?>
<div class="puus-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
