<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\RefSchool;
/* @var $this yii\web\View */
/* @var $model app\models\TblChildAthlete */

$this->title = 'Αθλητής: '. $model->surname .' '. $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Αθλητών', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Εμφάνιση Αθλητή'];
?>
<div class="tbl-child-athlete-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ενημέρωση', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Διαγραφή', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Εισαι σίγουρος πως θέλεις να κάνεις αυτή την διαγραφή ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dob',
            'photo',
            'athlete_card_id',
            'athlete_card_id_expire',
            'admission_date',
            'email:email',
             [
              'attribute'=>'school.school_name',
              'value'=> ($model->school_id)?$model->school->school_name:'-',
             ],
            'comments',
        ],
    ]) ?>

</div>
