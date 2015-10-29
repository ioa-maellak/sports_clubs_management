<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProfession */

$this->title = 'Create Ref Profession';
$this->params['breadcrumbs'][] = ['label' => 'Ref Professions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-profession-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
