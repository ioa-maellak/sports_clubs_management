<?php
use kartik\datecontrol\Module;



\Yii::$app->language = 'el';

return [
    'adminEmail' => 'admin@example.com',
    
    'dateControlSave' => [
        Module::FORMAT_DATE => 'php:Y-m-d', // saves as MySQL date
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
    
];
