<?php defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('path_vendor'))
{
    function path_vendor(){
        return 'assets/vendor/';
    }
}

if(!function_exists('path_web'))
{
    function path_web(){
        return 'assets/web/';
    }
}
