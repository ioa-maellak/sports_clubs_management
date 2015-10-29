<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_profession".
 *
 * @property string $id
 * @property string $profession_name
 *
 * @property TblMember[] $tblMembers
 */
class RefProfession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profession_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profession_name' => 'Profession Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMembers()
    {
        return $this->hasMany(TblMember::className(), ['profession_id' => 'id']);
    }
}
