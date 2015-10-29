<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMemberRole */

$this->title = Yii::t('app', 'Create Tbl Member Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tbl Member Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-member-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
