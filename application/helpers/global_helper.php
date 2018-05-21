<?php defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('setDateTime'))
{
    function setDateTime()
    {
        return date('Y-m-d H:i:s');
    }
}