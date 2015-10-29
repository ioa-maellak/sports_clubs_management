<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_parents".
 *
 * @property string $parent_id
 * @property string $member_id
 * @property string $athlete_id
 *
 * @property TblChildAthlete $athlete
 * @property TblMember $member
 */
class TblParents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'athlete_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent_id' => 'Parent ID',
            'member_id' => 'Member ID',
            'athlete_id' => 'Athlete ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAthlete()
    {
        return $this->hasOne(TblChildAthlete::className(), ['id' => 'athlete_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(TblMember::className(), ['id' => 'member_id']);
    }
}
