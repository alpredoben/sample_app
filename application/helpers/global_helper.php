<?php defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('setDateTime'))
{
    function setDateTime()
    {
        return date('Y-m-d H:i:s');
    }
}

if(!function_exists('getCategoryId'))
{
    function getCategoryId($name='')
    {
        $array = array(
            'kopi'      => 1,
            'mesin'     => 2,
            'sparepart' => 3
        );

        return empty($name) ? $array : $array[strtolower($name)];
    }
}