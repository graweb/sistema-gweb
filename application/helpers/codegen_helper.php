<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function p($a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}

function v($a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';

}

function clean_header($array){
    $CI = get_instance();
    $CI->load->helper('inflector');
    foreach($array as $a){
        $arr[] = humanize($a);
    }
    return $arr;
}