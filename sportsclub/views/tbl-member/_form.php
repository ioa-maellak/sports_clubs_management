<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

use app\models\RefAddress;
use app\models\RefRoles;

use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\typeahead\TypeaheadBasic;

/* @var $this yii\web\View */
/* @var $model app\models\TblMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-member-form">

    
    <?php $form = ActiveForm::begin(['layout' => 'horizontal','fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
   
    ],]) ?>
    
    
    <ul class="nav nav-tabs">
        <li class='active'> <a href='#s1' data-toggle='tab'> Κύρια Στοιχεία Ταυτοποίησης Μέλους </a>  </li>
        <li> <a href='#s2' data-toggle='tab'> Στοιχεία Διεύθυνσης Μέλους </a>  </li>
        <li> <a href='#s3' data-toggle='tab'> Στοιχεία Ρόλων Μέλους </a> </li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane active" id="s1">
            <br>
            <?= $form->field($model, 'surname',
            ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',]
            )?>
    
            <?= $form->field($model, 'first_name', [
            'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',]) ?>
       
            <?= $form->field($model, 'dob')->widget(DateControl::classname(), [
            'displayFormat' => 'dd/MM/yyyy',
            'autoWidget' => false,
            'widgetClass' => 'yii\widgets\MaskedInput',
            'options' => [
                'mask' => '99/99/9999',
                'clientOptions' => ['alias' =>  'mm/dd/yyyy']
                ]   ]) ?>
    
            <?= $form->field($model, 'national_id', [
            'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',]) ?>
            
            <?= $form->field($model, 'email',[
            'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->input('email') ?>
        
            <!-- <?= $form->field($model, 'profession_id',[ 'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->dropDownList(
            ArrayHelper::map(app\models\RefProfession::find()->orderBy('profession_name')->all(), 'id', 'profession_name'), ['prompt'=>'Επιλέξτε Επάγγελμα']) ?>  -->
    
            <?= $form->field($model, 'profession_id',[ 'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(app\models\RefProfession::find()->orderBy('profession_name')->all(), 'id', 'profession_name'),
                'language' => 'el',
                'options' => ['placeholder' => 'Επιλέξτε Επάγγελμα ...'],
                'pluginOptions' => [
                'allowClear' => true
                ],]); ?>
            
            <?php $model->isNewRecord ? $model->active_member = 1: $model->active_member = $model->active_member ; ?>
            <?= $form->field($model, 'active_member')->radioList(array('1'=>'Ναι',0=>'Όχι')); ?>
            
            
            <?= $form->field($model, 'admission_date', [
            'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(DatePicker::classname(), [
             'language'=> 'el',
             'type' => 2,
             'removeButton' => false,
             'pickerButton' => ['icon'=>'calendar','title' => 'Επιλέξτε την ημερομηνία εγγραφής του μέλους στο σύλλογο'],  
             'pluginOptions' => [
             'autoclose'=>true,
             'format' => 'dd/mm/yyyy' ]   ])?>
    
            <?= $form->field($model, 'admission_receipt', [
            'template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',]) ?>
         
    </div>
        <div class="tab-pane" id="s2">
            
            <br>
            
            <?php 
                $tmpar = RefAddress::find()->select('streetname')->asArray()->distinct()->orderby('streetname')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['streetname'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'streetname', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
            
            <?php 
                $tmpar = RefAddress::find()->select('streetnumber')->asArray()->distinct()->orderby('streetnumber')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['streetnumber'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'streetnumber', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
            <?php 
                $tmpar = RefAddress::find()->select('town')->asArray()->distinct()->orderby('town')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['town'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'town', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
             <?php 
                $tmpar = RefAddress::find()->select('area')->asArray()->distinct()->orderby('area')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['area'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'area', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
            <?php 
                $tmpar = RefAddress::find()->select('postcode')->asArray()->distinct()->orderby('postcode')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['postcode'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'postcode', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
            <?php 
                $tmpar = RefAddress::find()->select('region')->asArray()->distinct()->orderby('region')->all();
                $i=0;
                foreach ($tmpar as $key=>$v)
                {
                    
                    $data[$i] = $tmpar[$key]['region'];
                    $i+=1;
                }    
            ?>
            <?= $form->field($refaddressModel, 'region', ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',])->widget(TypeaheadBasic::classname(), [
                //'data' => ArrayHelper::map(app\models\RefAddress::find()->orderBy('streetname')->all(), 'id', 'streetname'),
                'name' => 'state_17',
                'language' => 'el',
                'data' => $data,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => 'Filter as you type ...'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0] 	]);?>
            
        </div>
        <div class="tab-pane" id="s3"> 
            <?php 
                $roles = RefRoles::find()->asArray()->orderBy('role_name')->all(); 
                $rolesArr = ArrayHelper::map( $roles, 'id' , 'role_name');
                foreach ($rolesArr as $key=>$v) 
                {
                    if (isset($ra->rolesArr[$key]) && $ra->rolesArr[$key] <> 0)
                    { 
                        $k = $ra->rolesArr[$key];
                    } 
                    else
                    {
                        $k = $key;
                    }
                    echo $form->field($ra, 'rolesArr['.$key.']',
                        ['template' => '{label} <div class="row"><div class="col-xs-4">{input}{error}{hint}</div></div>',]
                        )->checkbox(['value'=>$k, 'checked'=>true, 'unchecked'=>'0'])->label($v);    
                }
             ?>             
        </div>    
       </div>
    </div>
    
    <hr>        
    <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Δημιουργία' : 'Ενημέρωση', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>   
           
    </div>
  
    <?php ActiveForm::end(); ?>
           
 </div>  

