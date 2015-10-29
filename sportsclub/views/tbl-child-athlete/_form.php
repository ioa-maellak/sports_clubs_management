<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
$formatter = \Yii::$app->formatter;
/* @var $this yii\web\View */
/* @var $model app\models\TblChildAthlete */
/* @var $form yii\widgets\ActiveForm */
?>





<div class="row">
    <?php if (!empty($model->photo)){ ?>
         <div class="col-lg-3">
            <img src="<?= Yii::$app->request->baseUrl . '/' . $model->photo ?>" height="100px" class="img-circle" >  
        </div>
    <?php } else { ?> 
   <div class="col-lg-6">
    <img src="<?= Yii::$app->request->baseUrl . '/images/default.png' ?>" height="100px" class="img-circle" >  
   </div>
    <?php } ?> 
    <div class="col-lg-4"> 
        <?= $form->field($model, 'photo_file')->fileInput(['maxlength' => true, 'style'=>'width:500px']) ?>
    </div> 
    
</div>  
<div class="row">
    <div class="col-lg-3">
         <?= $form->field($model, 'surname')->textInput(['maxlength'=>true, 'style'=>'width:200px']) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'style'=>'width:200px' ]) ?>
    </div>  
    <div class="col-lg-3">
        <?= $form->field($model, 'dob')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '99/99/9999' ,]);
            ?>
    </div>
</div>
    <div class="row">
    <div class="col-lg-3">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?></div>
    <div class="col-lg-3">
        <?= $form->field($model, 'school_id')->dropDownList(
             ArrayHelper::map(\app\models\RefSchool::find()->all(), 'id', 'school_name'),  ['prompt' => 'Επιλέξτε Σχολείο'], array('style'=>'width:200px')
        ) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">  
     <?= $form->field($model,'admission_date')->widget(DatePicker::className(),
        [ 'language' => 'el',
          'dateFormat' => 'dd/MM/yyyy',
          'clientOptions' => [
            'changeMonth'=> true,
            'changeYear'=> true,
            'htmlOptions'=>['style'=>'width:800px;', 'font-weight'=>'x-small',],
        ]]) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'athlete_card_id')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'athlete_card_id_expire')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '99/99/9999' ,]) ?>
    </div>
</div>
    <?= $form->field($model, 'comments')->textArea(['maxlength' => true, 'style'=>'width:800px']) ?>
  
 