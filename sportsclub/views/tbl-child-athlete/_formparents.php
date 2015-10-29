<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;
use app\models\TblChildAthlete;
use app\models\TblMember;
use app\models\TblParents;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\widgets\Pjax;
//use yii\jui;
/* @var $this yii\web\View */
/* @var $model app\models\TblMember */
/* @var $form yii\widgets\ActiveForm */
?>

    
    <?php if (Yii::$app->controller->action->id == 'update') {  $parentstotal = count($parentsmodel); ?>
    <div class="form">
        <div class="form-group">   
         <?php if ($parentstotal == 2) {?>
         <?php foreach($parentsmodel as $parentsmodel){ ?>
                <br><br>
                <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
                <?= Html::input('text', 'fullname', $parentsmodel->surname . ' '. $parentsmodel->first_name, ['disabled' => true, 'style'=>'width:200px']); ?>
                <?= Html::a('Διαγραφή Κηδεμόνα', ['tbl-child-athlete/delete-parent', 'memberid' => $parentsmodel->id, 'athleteid'=>$model->id], ['class'=>'btn btn-primary', 'data-method' => 'post',  'data-confirm' => 'Θέλετε να διαγράψετε τον κηδεμόνα?',]) ?>
                <br><br>  
                <?php } ?>
           <?php } elseif ($parentstotal == 1) {?>
         <?php foreach($parentsmodel as $parentsmodel){ ?>
                <br><br>
                <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
                <?= Html::input('text', 'fullname', $parentsmodel->surname . ' '. $parentsmodel->first_name, ['disabled' => true, 'style'=>'width:200px']); ?>
                <?= Html::a('Διαγραφή Κηδεμόνα', ['tbl-child-athlete/delete-parent', 'memberid' => $parentsmodel->id, 'athleteid'=>$model->id], ['class'=>'btn btn-primary', 'data-method' => 'post',  'data-confirm' => 'Θέλετε να διαγράψετε τον κηδεμόνα?',]) ?>
                <br><br>
                <?php } ?>
                <?php 
                $parents = new TblParents();
                $membersearch = TblMember::find()
                ->select(['CONCAT(surname, " ", first_name, " ", national_id) as label', 'CONCAT(surname, " ", first_name) as value','id as id'])
                ->asArray()
                ->all();                
                ?>   
                 <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
                <?php echo AutoComplete::widget([
                                    'name' => 'member0',
                                    'id' => 'jjj',
                                    'clientOptions' => [
                                    'source' => $membersearch,
                                    'autoFill'=>true,
                                    'minLength'=>'2',
                                    'select' => new JsExpression("function( event, ui ) {                    
                                    $('#tblparents-member_id-0').val(ui.item.id);
                                    }")],
                                    ]); ?>
                <?= Html::activeHiddenInput($parents, 'member_id[0]')?>
                <?= Html::a("Ανανέωση", ['tbl-child-athlete/create'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
                <br><br>  
           <?php } else { ?>
                <?php 
                $parents = new TblParents();
                $membersearch = TblMember::find()
                ->select(['CONCAT(surname, " ", first_name, " ", national_id) as label', 'CONCAT(surname, " ", first_name) as value','id as id'])
                ->asArray()
                ->all();
                ?>   
                <br><br> 
                <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
                <?php echo AutoComplete::widget([
                                    'name' => 'member0',
                                    'id' => 'jjj',
                                    'clientOptions' => [
                                    'source' => $membersearch,
                                    'autoFill'=>true,
                                    'minLength'=>'2',
                                    'select' => new JsExpression("function( event, ui ) {                    
                                    $('#tblparents-member_id-0').val(ui.item.id);
                                    }")],
                                    ]); ?>
                <?= Html::activeHiddenInput($parents, 'member_id[0]')?>
                <?= Html::a("Ανανέωση", ['tbl-child-athlete/create'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
                <br><br> 
                <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
                <?php  echo AutoComplete::widget([
                                    'name' => 'member1',
                                    'id' => 'ddd',
                                    'clientOptions' => [
                                    'source' => $membersearch,
                                    'autoFill'=>true,
                                    'minLength'=>'2',
                                    'select' => new JsExpression("function( event, ui ) {
                                            $('#tblparents-member_id-1').val(ui.item.id);
                                     }")],
                                     ]); ?>
                <?= Html::activeHiddenInput($parents, 'member_id[1]')?>
                <?= Html::a("Ανανέωση", ['tbl-child-athlete/create'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
               <br><br> 
            <?php } ?>     
      </div>  
    </div>
        <?php } ?>     
    
    
    
    <?php if (Yii::$app->controller->action->id == 'create') {?>
    <div class="form">
         <div class="form-group">
         <br>
         <br>
           <?php Pjax::begin(); ?>
            
            <?php 
                $parents = new TblParents();
                $membersearch = TblMember::find()
                ->select(['CONCAT(surname, " ", first_name, " ", national_id) as label', 'CONCAT(surname, " ", first_name) as value','id as id'])
                ->asArray()
                ->all();
            ?>   
   
            <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:     ');?>
            <?php echo AutoComplete::widget([
                                'name' => 'member0',
                                'id' => 'jjj',
                                'clientOptions' => [
                                'source' => $membersearch,
                                'autoFill'=>true,
                                'minLength'=>'2',
                                'select' => new JsExpression("function( event, ui ) {                    
                                $('#tblparents-member_id-0').val(ui.item.id);
                                }")],
                                ]); ?>
            <?= Html::activeHiddenInput($parents, 'member_id[0]')?>
            <?= Html::a("Ανανέωση", ['tbl-child-athlete/create'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
   
            <br><br>
            <?= Html::label('Ονοματεπώνυμο Κηδεμόνα:');?>
            <?php  echo AutoComplete::widget([
                                'name' => 'member1',
                                'id' => 'ddd',
                                'clientOptions' => [
                                'source' => $membersearch,
                                'autoFill'=>true,
                                'minLength'=>'2',
                                'select' => new JsExpression("function( event, ui ) {
                                        $('#tblparents-member_id-1').val(ui.item.id);
                                 }")],
                                 ]); ?>
            <?= Html::activeHiddenInput($parents, 'member_id[1]')?>
            <?= Html::a("Ανανέωση", ['tbl-child-athlete/create'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
            <br> <br>
             <?php Pjax::end(); ?>
     </div>  
</div>         
    <?php } ?>  
           

<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 100000000);
});
JS;
$this->registerJs($script);
?>
    
    
    
