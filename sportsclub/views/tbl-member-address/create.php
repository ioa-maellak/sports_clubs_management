<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMemberAddress */

$this->title = 'Create Tbl Member Address';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Member Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-member-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
