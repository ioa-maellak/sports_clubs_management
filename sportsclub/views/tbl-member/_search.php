<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblMemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'profession_id') ?>

    <?php // echo $form->field($model, 'national_id') ?>

    <?php // echo $form->field($model, 'admission_date') ?>

    <?php // echo $form->field($model, 'active_member') ?>

    <?php // echo $form->field($model, 'admission_receipt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
