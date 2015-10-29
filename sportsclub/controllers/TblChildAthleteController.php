<?php

namespace app\controllers;

use Yii;
use app\models\TblChildAthlete;
use app\models\TblMember;
use app\models\TblParents;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\TblAthleteSearch;

/**
 * TblChildAthleteController implements the CRUD actions for TblChildAthlete model.
 */
class TblChildAthleteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                   
                ],
            ],
        ];
    }

    /**
     * Lists all TblChildAthlete models.
     * @return mixed
     */
    public function actionIndex()
            
    {
         $query = TblChildAthlete::find();
         $dataProvider = new ActiveDataProvider([
            'query' => $query,             
        ]);
      
        $searchModel = new TblAthleteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel, 
        ]);
    }
   
    /**
     * Displays a single TblChildAthlete model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        
             
        ]);
    }

    /**
     * Creates a new TblChildAthlete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblChildAthlete();
        $membermodel = new TblMember();
     
        if ($model->load(Yii::$app->request->post()) ) {
          
            $model->save(true);
            if (isset($_POST['TblParents'])) {
                $i=0;
                foreach ($_POST['TblParents']['member_id'] as $i=>$parentsmodel) {
                   if (!empty($_POST['TblParents']['member_id'][$i])) {
                    $parents = new TblParents();
                    $parents->athlete_id= $model->id;
                    $parents->member_id= $_POST['TblParents']['member_id'][$i];
                    $parents->save(true);
                   }
                }
            }
            
           // return $this->redirect(['view', 'id' => $model->id]);
               return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'membermodel'=>$membermodel,
            ]);
        }
    }
  
    /**
     * Updates an existing TblChildAthlete model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //select member details via junction table tblparents
        $parentsmodel = $model->parents;
               
        if ($model->load(Yii::$app->request->post()) ) {
            $model->save();
            $parentstotal = count($parentsmodel);
            if (isset($_POST['TblParents'])) {
                $i=0;
                foreach ($_POST['TblParents']['member_id'] as $i=>$parentsmodel) {
                   if (!empty($_POST['TblParents']['member_id'][$i])) {
                    $parents = new TblParents();
                    $parents->athlete_id= $model->id;
                    $parents->member_id= $_POST['TblParents']['member_id'][$i];
                    $parents->save(true);
                   }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'parentsmodel'=>$parentsmodel,
            ]);
        }
    }

    /**
     * Deletes an existing TblChildAthlete model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //delete parents
       foreach (TblParents::find()->where(['athlete_id' => $id])->all() as $parent) {
        $parents = TblParents::deleteAll(['athlete_id' => $id]);
        $parent -> delete();
       }
        //delete image file
       $athlete = TblChildAthlete::findOne($id);
       $image = Yii::$app->basePath . '/web/' . $athlete->photo;
       if (!empty($athlete->photo)){
        unlink($image);
       }
       //delete athlete
       $this->findModel($id)->delete();
        
      return $this->redirect(['index']);
    }
    
    public function actionDeleteParent($memberid, $athleteid)
    {
        foreach (TblParents::find()->where(['member_id' => $memberid, 'athlete_id'=>$athleteid])->all() as $parent) {
            $parent ->delete();
        }
        return $this->redirect(['update', 'id' => $athleteid]);
    }
    
    
    public function actionAutoRefresh()
    {
        return $this->render('auto-refresh');
    }
  
    /**
     * Finds the TblChildAthlete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblChildAthlete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblChildAthlete::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}
