<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblAthleteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-child-athlete-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'athlete_card_id') ?>

    <?php // echo $form->field($model, 'athlete_card_id_expire') ?>

    <?php // echo $form->field($model, 'admission_date') ?>

    <?php // echo $form->field($model, 'email') ?>

  <?php  echo $form->field($model, 'school.school_name') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
