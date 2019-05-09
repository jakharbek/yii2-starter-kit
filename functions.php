<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;

/**
 * @param $message
 * @param string $category
 * @param array $params
 * @return string
 */
function __($message,$category = "main", $params = array())
{
    return Yii::t($category, $message, $params, Yii::$app->language);
}


/**
 * @param string $url
 * @param bool $scheme
 * @return string
 */
function _url($url = '', $scheme = false){
    return \yii\helpers\Url::to($url, $scheme);
}

function url($url = '', $scheme = false)
{
    return Url::to($url, $scheme);
}

function he($text)
{
    return Html::encode($text);
}

function ph($text)
{
    return HtmlPurifier::process($text);
}

function t($message, $params = [], $category = 'app', $language = null)
{
    return Yii::t($category, $message, $params, $language);
}

function param($name, $default = null)
{
    return ArrayHelper::getValue(Yii::$app->params, $name, $default);
}

function dd(){
    $args = func_get_args();
    if(count($args) == 0){exit();}
    echo "<pre>";
    foreach ($args as $arg){
        print_r($arg);
    }
    exit();
}

/**
 * @param $first
 * @param $last
 * @param string $step
 * @param string $output_format
 * @return array
 */
function date_range($first, $last, $step = '+1 day', $output_format = 'd.m.Y' ) {

    $dates = array();
    $current = ($first);
    $last = ($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

/**
 * @param array $array
 * @return int
 */
function depth(array $array) {
    $max_depth = 1;

    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = depth($value) + 1;

            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
    }

    return $max_depth;
}