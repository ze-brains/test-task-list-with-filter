<?php

$data = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

if (file_exists(__DIR__ . '/local.db.php')) {
    $localData = require(__DIR__ . '/local.db.php');
    $data = \yii\helpers\ArrayHelper::merge($data, $localData);
}

return $data;