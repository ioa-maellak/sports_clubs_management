<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_school".
 *
 * @property string $id
 * @property string $school_name
 *
 * @property TblChildAthlete[] $tblChildAthletes
 */
class RefSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_name' => 'Σχολείο',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblChildAthletes()
    {
        return $this->hasMany(TblChildAthlete::className(), ['school_id' => 'id']);
    }
}
