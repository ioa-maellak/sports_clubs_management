<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_address".
 *
 * @property string $id
 * @property string $streetname
 * @property integer $streetnumber
 * @property string $town
 * @property string $region
 * @property string $postcode
 * @property string $area
 *
 * @property TblMemberAddress[] $tblMemberAddresses
 */
class RefAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['streetnumber', 'default', 'value' => '0'],
            [['streetname', 'town', 'region', 'postcode', 'area'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'streetname' => 'Οδός',
            'streetnumber' => 'Αριθμός',
            'town' => 'Πόλη',
            'region' => 'Νομός',
            'postcode' => 'ΤΚ',
            'area' => 'Περιοχή / Χωριό',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMemberAddresses()
    {
        return $this->hasMany(TblMemberAddress::className(), ['address_id' => 'id']);
    }
}
