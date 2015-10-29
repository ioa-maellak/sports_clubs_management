<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use app\models\TblMember;
use app\models\RefAddress;
use app\models\TblMemberAddress;
use app\models\RefRoles;
use app\models\TblMemberRole;
use app\models\TblMemberSearch;
use app\models\arrayModel;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;


/**
 * TblMemberController implements the CRUD actions for TblMember model.
 */
class TblMemberController extends Controller
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
     * Lists all TblMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblMemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblMember model.
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
     * Creates a new TblMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblMember();
        $refaddressModel = new RefAddress();
        $memberaddressModel = new TblMemberAddress();
        $ra = new arrayModel;
        
        if ($model->load(Yii::$app->request->post()) && $refaddressModel->load(Yii::$app->request->post()) && $model->save()) 
        {
            $ra->load(Yii::$app->request->post());
            //echo "sto post toy create";
            //print_r($ra->rolesArr);
            $i=0;
            foreach ($ra->rolesArr as $key=>$v) 
            {
                //echo $key." ra->rolesrr ". $v. " <br>";
                if ($ra->rolesArr[$key] <> 0)
                {
                    $rolesArr = new TblMemberRole;
                    $rolesArr->role_member_id = $model->id;
                    //$rolesArr->role_id = $ra->rolesArr[$key];
                    $rolesArr->role_id = $ra->rolesArr[$key];
                    $rolesArr->save();
                }
                $i+=1;
            }
            $refaddressModel2 = RefAddress::find()->where(['streetname' => $refaddressModel->streetname])
                                                  ->andwhere(['streetnumber' => $refaddressModel->streetnumber])
                                                  ->andwhere(['town' => $refaddressModel->town]) 
                                                  ->andwhere(['area' => $refaddressModel->area])
                                                  ->andwhere(['region' => $refaddressModel->region])
                                                  ->andwhere(['postcode' => $refaddressModel->postcode])
                                                  ->one();
            if ($refaddressModel2)
            {
                $refaddressModel2->load(Yii::$app->request->post());
                $refaddressModel2->save();
                $memberaddressModel->address_member_id = $model->id;
                $memberaddressModel->address_id = $refaddressModel2->id;
                $memberaddressModel->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                if ($refaddressModel->streetname <> "" || $refaddressModel->area <> "")
                {
                    $refaddressModel->save();
                    $memberaddressModel->address_member_id = $model->id;
                    $memberaddressModel->address_id = $refaddressModel->id;
                    $memberaddressModel->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else 
                {
                    return $this->redirect(['view', 'id' => $model->id]);  
                }
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'refaddressModel' => $refaddressModel,
                'ra' => $ra,]);
        }
    }

    
    /**
     * Updates an existing TblMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ra = new arrayModel;
        $tmp_ra = new arrayModel;
        $memberroles = TblMemberRole::find()->where(['role_member_id' => $model->id])->indexby('role_id')->all();
        $memberaddressModel = TblMemberAddress::find()->where(['address_member_id' => $model->id])->one();
        
        // The necessary for ROLES definition
        $tmp_ra->rolesArr = RefRoles::find()->asArray()->all(); 
        $tmp_ra->rolesArr = ArrayHelper::map($tmp_ra->rolesArr, 'id' , 'role_name');
        foreach ($tmp_ra->rolesArr as $key=>$v)
            $tmp_ra->rolesArr[$key] = 0;
        
        foreach ($memberroles as $key=>$v)
        {
            if (isset($tmp_ra->rolesArr[$key]))
            {
                $tmp_ra->rolesArr[$key] = $key;
                
            }  
        }
        foreach ($tmp_ra->rolesArr as $keys=>$v)
        {
            $ra->rolesArr[$keys] = $v;
        }
        
        // The necessary for ADDRESS definition
        if ($memberaddressModel) 
        {
            
            $refaddressModel = RefAddress::find()->where(['id' => $memberaddressModel->address_id])->one();
        }
        else 
        {         
            $memberaddressModel = new TblMemberAddress();
            $refaddressModel = new RefAddress();
        }
        
        // The necessary for the POST
        if ($model->load(Yii::$app->request->post()) && $refaddressModel->load(Yii::$app->request->post()) && $model->save()) 
        {
            
            $memberroleModelar = TblMemberRole::find()->where(['role_member_id' => $id])->all();
            foreach ($memberroleModelar as $key=>$v) 
            {
                $memberroleModelar[$key] -> delete();
            }
            $ra->load(Yii::$app->request->post());
            foreach ($ra->rolesArr as $key=>$v) 
            {
                if ($ra->rolesArr[$key] <> 0)
                {
                    $rolesArr = new TblMemberRole;
                    $rolesArr->role_member_id = $model->id;
                    $rolesArr->role_id = $ra->rolesArr[$key];
                    $rolesArr->save();
                }
            }
            
            $refaddressModel2 = RefAddress::find()->where(['streetname' => $refaddressModel->streetname])
                                                  ->andwhere(['streetnumber' => $refaddressModel->streetnumber])
                                                  ->andwhere(['town' => $refaddressModel->town]) 
                                                  ->andwhere(['area' => $refaddressModel->area])
                                                  ->andwhere(['region' => $refaddressModel->region])
                                                  ->andwhere(['postcode' => $refaddressModel->postcode])
                                                  ->one();
            if ($refaddressModel2)
            {
                $refaddressModel2->load(Yii::$app->request->post());
                $refaddressModel2->save();
                $memberaddressModel->address_member_id = $model->id;
                $memberaddressModel->address_id = $refaddressModel2->id;
                $memberaddressModel->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                $refaddressModel3 = new RefAddress();
                if ($refaddressModel->streetname <> "" || $refaddressModel->area <> "")
                {
                    $refaddressModel3->load(Yii::$app->request->post());
                    $refaddressModel3->save();
                    $memberaddressModel->address_member_id = $model->id;
                    $memberaddressModel->address_id = $refaddressModel3->id;
                    $memberaddressModel->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else 
                {
                    $memberaddressModel = TblMemberAddress::find()->where(['address_member_id' => $id])->one();
                    if ($memberaddressModel)    
                    {
                        $memberaddressModel -> delete();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //$memberaddressModel->address_member_id = $model->id;
            //$memberaddressModel->address_id = $refaddressModel->id;
            //$memberaddressModel->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'refaddressModel' => $refaddressModel,
                'ra' => $ra,]);
        }
    }

    
    /**
     * Deletes an existing TblMember model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $memberaddressModel = TblMemberAddress::find()->where(['address_member_id' => $id])->one();
        if ($memberaddressModel) 
        {
            $memberaddressModel -> delete();
        }
        
        $memberroleModelar = TblMemberRole::find()->where(['role_member_id' => $id])->all();
        foreach ($memberroleModelar as $key=>$v) 
        {
            $memberroleModelar[$key] -> delete();
        }
        
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the TblMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblMember::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
