<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_roles".
 *
 * @property string $id
 * @property string $role_name
 *
 * @property TblMemberRole[] $tblMemberRoles
 */
class RefRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_name' => Yii::t('app', 'Role Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMemberRoles()
    {
        return $this->hasMany(TblMemberRole::className(), ['role_id' => 'id']);
    }
}
