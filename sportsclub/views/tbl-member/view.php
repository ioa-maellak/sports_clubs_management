<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblMember */

//$this->title = "Μέλος: #".$model->id;
$this->title = "Μέλος: ".$model->surname . " " .$model->first_name ;
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Μελών', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Εμφάνιση Μέλους', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ενημέρωση', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Διαγραφή', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Είσαι σίγουρος πως θέλεις να κάνεις αυτή τη διαγραφή;',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        //'panel'=>$panel,
        'attributes' => [
            //'id',
            //'surname',
            //'first_name',
            
            //['attribute'=>'dob','format'=>['date']],
            //['attribute'=>'dob','format'=>['DateTime','php:d-m-Y']],
            ['attribute'=>'dob','format'=>['DateTime','dd/MM/yyyy']],
            //'dob',
            'email:email',
            ['label' => 'Επάγγελμα',
             'value' => $model->profession?$model->profession->profession_name:''
            ],
            'national_id',
            'admission_date',
            //'active_member:boolean',
            [
    'attribute' => 'active_member',
    'value' =>  $model->active_member ? 'Ναι' : 'Όχι'
],
            'admission_receipt',
        ],
    ]) ?>

</div>
