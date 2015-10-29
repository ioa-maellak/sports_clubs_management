<?php

namespace app\models;

use Yii;
use app\models\RefProfession;

/**
 * This is the model class for table "tbl_member".
 *
 * @property string $id
 * @property string $surname
 * @property string $first_name
 * @property string $dob
 * @property string $email
 * @property string $profession_id
 * @property string $national_id
 * @property string $admission_date
 * @property integer $active_member
 * @property string $admission_receipt
 *
 * @property TblAttendanceMember[] $tblAttendanceMembers
 * @property RefProfession $profession
 * @property TblMemberAddress[] $tblMemberAddresses
 * @property TblMemberEnroll[] $tblMemberEnrolls
 * @property TblMemberRole[] $tblMemberRoles
 * @property TblParents[] $tblParents
 * @property TblTrainingTrainer[] $tblTrainingTrainers
 */
class TblMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'tbl_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dob'], 'safe'],
            //[['dob'], 'string', 'max' => 30],
            //[['dob'],'date', 'format'=>'dd/mm/yyyy'],
            //[['dob'],'date'],
            [['profession_id'], 'integer'],
            [['active_member'], 'boolean'],
            //[['surname', 'first_name', 'email', 'national_id', 'admission_date'], 'string', 'max' => 45],
            [['surname', 'first_name'], 'required'],
            [['surname', 'first_name', 'email'], 'string', 'max' => 45],
            [['email'], 'email'],
            [['national_id', 'admission_date'], 'string', 'max' => 30],
            //
            [['admission_receipt'], 'string', 'max' => 10]
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
            'email' => 'Email',
            'profession_id' => 'Επάγγελμα',
            'national_id' => 'Αριθμός Ταυτότητας',
            'admission_date' => 'Ημερομηνία Εγγραφής στο Σύλλογο',
            'active_member' => 'Ενεργό Μέλος',
            'admission_receipt' => 'Αριθμός Απόδειξης για την Εγγραφή στο Σύλλογο',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAttendanceMembers()
    {
        return $this->hasMany(TblAttendanceMember::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(RefProfession::className(), ['id' => 'profession_id']);
    }
    
    public function getProfessionName()
    {
        return $this->profession;
    }
    
    public function getActiveMember()
    {
        return $this->active_member ? 'Ναι' : 'Όχι';
    }
      
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMemberAddresses()
    {
        return $this->hasMany(TblMemberAddress::className(), ['address_member_id' => 'id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMemberEnrolls()
    {
        return $this->hasMany(TblMemberEnroll::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMemberRoles()
    {
        return $this->hasMany(TblMemberRole::className(), ['role_member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblParents()
    {
        return $this->hasMany(TblParents::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblTrainingTrainers()
    {
        return $this->hasMany(TblTrainingTrainer::className(), ['trainer_id' => 'id']);
    }
    
    public function getActiveMemberLabel()
    {
    return $this->acive_member ? 'Yes' : 'No';
    }
}
