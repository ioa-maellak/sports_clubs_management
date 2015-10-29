<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_member_address".
 *
 * @property string $id
 * @property string $address_member_id
 * @property string $address_id
 *
 * @property TblMember $addressMember
 * @property RefAddress $address
 */
class TblMemberAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_member_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_member_id', 'address_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_member_id' => 'Address Member ID',
            'address_id' => 'Address ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressMember()
    {
        return $this->hasOne(TblMember::className(), ['id' => 'address_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(RefAddress::className(), ['id' => 'address_id']);
    }
}
