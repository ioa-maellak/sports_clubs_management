<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblMember */

$this->title = 'Δημιουργία Μέλους';
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Μελών', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'refaddressModel' => $refaddressModel,
        'ra' => $ra,
        //'memberaddressModel' => $memberaddressModel,
    ]) ?>

</div>
