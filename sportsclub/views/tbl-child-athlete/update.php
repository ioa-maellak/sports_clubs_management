<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\TblChildAthlete */

$this->title = 'Ενημέρωση Αθλητή';
        //. ': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Λίστα Αθλητών', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ενημέρωση Αθλητή';
?>

<div class="form-group">

    <h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->errorSummary(array($model));?>
    
    <?=  Tabs::widget([
    'items' => [
        [
                'label' => 'Αθλητής/Αθλήτρια',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form]),
                'active' => true
            ],
         [
                'label' => 'Γονείς',
                'content' => $this->render('_formparents', ['parentsmodel' => $parentsmodel, 'model' => $model,'form' => $form]),
              
            ],
            
        ],
        'options'=>[
            'collapsible' => TRUE,
            'enctype' => 'multipart/form-data',
        ],
        
     ]);?>
         
    </div>  
    <div class="form-group">
  
   <?= Html::submitButton('Ενημέρωση',  ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>             
    </div>
  
