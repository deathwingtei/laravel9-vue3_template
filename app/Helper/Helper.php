<?php

namespace App\Helper;

class Helper
{
    public static function instance()
     {
         return new Helper();
     }

    public function callbacktest()
    {
        return "Callback Complete";
    }
}