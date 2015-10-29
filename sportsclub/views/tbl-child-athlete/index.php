<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\RefSchool;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Λίστα Αθλητών';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-child-athlete-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Δημιουργία Νέου Αθλητή', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   
   <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

               'surname',
               'first_name',
                'dob',
                [
                   'attribute' =>  'school',
                    'label'=> 'Σχολείο',
                    'value'=>  'school.school_name', 
                ],
            ['class' => 'yii\grid\ActionColumn'],
            
        ],
    ]); ?>
    
    
</div>
