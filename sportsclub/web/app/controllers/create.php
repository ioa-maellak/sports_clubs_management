<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAddress */

$this->title = 'Create Ref Address';
$this->params['breadcrumbs'][] = ['label' => 'Ref Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
