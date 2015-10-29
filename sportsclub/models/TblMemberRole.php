<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_member_role".
 *
 * @property string $id
 * @property string $role_member_id
 * @property string $role_id
 *
 * @property TblMember $roleMember
 * @property RefRoles $role
 */
class TblMemberRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_member_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_member_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_member_id' => Yii::t('app', 'Role Member ID'),
            'role_id' => Yii::t('app', 'Role ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleMember()
    {
        return $this->hasOne(TblMember::className(), ['id' => 'role_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(RefRoles::className(), ['id' => 'role_id']);
    }
}
