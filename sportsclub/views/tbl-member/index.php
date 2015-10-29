<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\RefProfession;

 Yii::$app->formatter->booleanFormat = ['Όχι', 'Ναι'];
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Tbl Members';
$this->title = 'Λίστα Μελών';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tbl-member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Δημιουργία Νέου Μέλους', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'surname',
            'first_name',
            //'national_id',
            
            //['attribute'=>'dob','format'=>['DateTime','php:d-m-Y']],
            
            //'email:email',
               
            ['attribute' => 'profession_id',
             'label' => 'Επάγγελμα',
             'value' => 'profession.profession_name'],
                    
  

            // 'national_id',
            // 'admission_date',
             //'active_member:boolean',
              ['attribute' => 'active_member',
             'label' => 'Ενεργό Μέλος',
             'value' => 'activeMember'],          
            
        
               
            // 'admission_receipt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
