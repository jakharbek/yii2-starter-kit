<?php
define('DS', DIRECTORY_SEPARATOR);
//  /common
Yii::setAlias('common', dirname(__DIR__));
//  /
Yii::setAlias('root', dirname(dirname(__DIR__)) . DS);
//  /frontend
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
//  /backend
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
//  /console
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
//  /api
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');
//  /static
Yii::setAlias('static', dirname(dirname(__DIR__)) . '/static');

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = 'on';
}
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $_SERVER['REMOTE_ADDR'] = trim($ips[0]);
} elseif (isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CLIENT_IP'];
}