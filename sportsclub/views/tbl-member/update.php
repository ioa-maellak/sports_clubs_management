<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblMember */

//$this->title = 'Update Tbl Member: ' . ' ' . $model->id;
$this->title = 'Ενημέρωση Μέλους: '.$model->surname . " " .$model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Μελών', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => "#".$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ενημέρωση Μέλους';
?>
<div class="tbl-member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'refaddressModel' => $refaddressModel,
        'ra' => $ra,
    ]) ?>

</div>
