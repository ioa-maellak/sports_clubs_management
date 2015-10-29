<?php

namespace app\models;

use Yii;
use yii\helpers;
use yii\web\UploadedFile;
use app\models\RefSchool;

/**
 * This is the model class for table "tbl_child_athlete".
 *
 * @property string $id
 * @property string $surname
 * @property string $first_name
 * @property string $dob
 * @property string $photo
 * @property string $athlete_card_id
 * @property string $athlete_card_id_expire
 * @property string $admission_date
 * @property string $email
 * @property string $school_id
 * @property string $comments
 *
 * @property TblAthleteEnroll[] $tblAthleteEnrolls
 * @property TblAttendanceAthlete[] $tblAttendanceAthletes
 * @property RefSchool $school
 * @property TblParents[] $tblParents
 */
class TblChildAthlete extends \yii\db\ActiveRecord
{
    public $photo_file;
    public $fullname;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_child_athlete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        //    [['dob', 'admission_date'], 'safe'],
            [['school_id'], 'integer'],
            [['surname', 'first_name', 'athlete_card_id', 'email'], 'string', 'max' => 45],
            [['photo'], 'string', 'max' => 255],
            ['photo_file', 'safe'],
            ['fullname', 'string'],
            ['photo_file', 'file',  'maxSize'=>1024 * 1024 * 2],
            [['comments'], 'string', 'max' => 100],
            [['dob', 'admission_date'], 'required'],
    //        [['dob', 'athlete_card_id_expire', 'admission_date'], 'date','format' => 'dd/mm/yyyy'],
            ['athlete_card_id_expire', 'default', 'value' => null],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Επώνυμο',
            'first_name' => 'Όνομα',
            'dob' => 'Ημερομηνία Γέννησης',
            'photo' => 'Φωτογραφία',
            'photo_file'=> 'Επιλέξτε Φωτογραφία',
            'athlete_card_id' => 'Αθλητική κάρτα',
            'athlete_card_id_expire' => 'Ημερομηνία λήξης κάρτας',
            'admission_date' => 'Ημερομηνία Εγγραφής',
            'email' => 'Email',
            'school_id'=>'Σχολείο',
            'comments' => 'Σχόλια',
        ];
    }
    
    public function beforeSave($insert)
        {
            //Display DateofBirth, Admission and Card Expired dates as dd/mm/yyyy
            //Store DateofBirth, Admission and Card Expired dates as yyyy-mm-dd
            $dateofbirth= \DateTime::createFromFormat('d/m/Y',$this->dob);
            $this->dob=$dateofbirth->format('Y-m-d');
            $admissiondate= \DateTime::createFromFormat('d/m/Y',$this->admission_date);
            $this->admission_date=$admissiondate->format('Y-m-d');
            
            if (!empty($this->athlete_card_id_expire)){
                $cardexpiredate= \DateTime::createFromFormat('d/m/Y',$this->athlete_card_id_expire);
                $this->athlete_card_id_expire=$cardexpiredate->format('Y-m-d');
            }
            //Upload  selected photo file and set the photo file name
            if (Yii::$app->controller->action->id == 'create'){
                   
               $this->photo_file = UploadedFile::getInstance($this, 'photo_file');
               if (!empty($this->photo_file->name)){
                   $this->photo_file->saveAs('images/' . time(). '.'.$this->photo_file->extension);
               $this->photo = 'images/' . time() . '.'.$this->photo_file->extension;
               }             
            }
            if (Yii::$app->controller->action->id == 'update'){
               $this->photo_file = UploadedFile::getInstance($this, 'photo_file');
               if (!empty($this->photo_file->name)){
                   $current_image = Yii::$app->basePath . '/web/' . $this->photo;
                   if (!empty($this->photo)){
                   unlink($current_image);
                   }
                  
                  $this->photo_file->saveAs('images/' . time(). '.'.$this->photo_file->extension);
                  $this->photo = 'images/' . time() . '.'.$this->photo_file->extension;
                  
               }             
            }
            parent::beforeSave($insert);
            return true;
        }
    
    public function afterFind()
        {
            //Display DateofBirth, Admission and Card Expired dates as dd/mm/yyyy
            //Store DateofBirth, Admission and Card Expired dates as yyyy-mm-dd
            $dateofbirth= \DateTime::createFromFormat('Y-m-d',$this->dob);
            $this->dob=$dateofbirth->format('d/m/Y');
            $admissiondate= \DateTime::createFromFormat('Y-m-d',$this->admission_date);
            $this->admission_date=$admissiondate->format('d/m/Y');
             if (isset($this->athlete_card_id_expire)){
            $cardexpiredate= \DateTime::createFromFormat('Y-m-d',$this->athlete_card_id_expire);
            $this->athlete_card_id_expire=$cardexpiredate->format('d/m/Y');
             }
             //Upload  selected photo file and set the photo file name
             
             if (Yii::$app->controller->action->id == 'update'){
               $this->photo_file = UploadedFile::getInstance($this, 'photo_file');
               if (!empty($this->photo_file->name)){
                  
                  
                  // $this->photo_file->saveAs('images/' . time(). '.'.$this->photo_file->extension);
                  // $this->photo = 'images/' . time() . '.'.$this->photo_file->extension;
                          
               
                   
               }  
            } else {
                   
                $this->photo_file = UploadedFile::getInstance($this, 'photo_file');
                if (!empty($this->photo_file->name)){
                   $this->photo_file->saveAs('images/' . time(). '.'.$this->photo_file->extension);
                   $this->photo = 'images/' . time() . '.'.$this->photo_file->extension;
                }   
            }    
            parent::afterFind();
            return true;
        }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAthleteEnrolls()
    {
        return $this->hasMany(TblAthleteEnroll::className(), ['athlete_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAttendanceAthletes()
    {
        return $this->hasMany(TblAttendanceAthlete::className(), ['child' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(RefSchool::className(), ['id' => 'school_id']);
    }
       
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblParents()
    {
        return $this->hasMany(TblParents::className(), ['athlete_id' => 'id']);
    }
   

    public function getParents()
    {
        return $this->hasMany(TblMember::className(), ['id' => 'member_id'])
            ->via('tblParents');
    }
}
