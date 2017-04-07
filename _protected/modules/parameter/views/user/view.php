<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-view">
<?php
print_r(Yii::$app->security->validatePassword('adminadmin', $model->password_hash));
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            'kode_unit',
            'group_id',
        ],
    ]) ?>

</div>
