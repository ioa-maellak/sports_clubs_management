<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRoles */

$this->title = 'Create Ref Roles';
$this->params['breadcrumbs'][] = ['label' => 'Ref Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
