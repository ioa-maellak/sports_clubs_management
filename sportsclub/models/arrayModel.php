<?php

namespace app\models;

use yii\base\Model;

class arrayModel extends Model

{
    public $rolesArr = array();
    
    public function rules()
    {
        return [
            //[['rolesArr'], 'string', 'max' => 45]
            ['rolesArr', 'each', 'rule' => ['integer']]
        ];
    }
    
}

