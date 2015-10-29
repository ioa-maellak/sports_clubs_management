<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\TblChildAthlete */

$this->title = 'Δημιουργία Αθλητή';
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Αθλητών', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-group">

    
    <h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->errorSummary(array($model,$membermodel));?>
    
    <?=  Tabs::widget([
    'items' => [
        [
                'label' => 'Αθλητής/Αθλήτρια',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form]),
                'active' => true
            ],
         [
                'label' => 'Γονείς',
                'content' => $this->render('_formparents', ['membermodel' => $membermodel, 'form' => $form]),
            //  'active' => true
            ],
            
        ],
        'options'=>[
            'collapsible' => TRUE,
            'enctype' => 'multipart/form-data',
            'selected'=>isset(Yii::$app->session['tabid'])?Yii::$app->session['tabid']:0,
	    'select'=>'js:function(event, ui) { 
	            var index=ui.index;
	            $.ajax({
	                "url":"'.Yii::$app->urlManager->createUrl('/site/tab-session').'",
	                "data":"tab="+index,
	            });
	    }',
        ],
        
     ]);?>
         
       
    
</div>
<div class="form-group">
  
   <?= Html::submitButton('Δημιουργία', ['class' => 'btn btn-primary']) ?>
 <?php ActiveForm::end(); ?> 
</div>

 