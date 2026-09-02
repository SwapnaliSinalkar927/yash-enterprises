<?php

namespace App\Helpers;

use DB;
use Str;
class CustomHelper
{  
    public static function camelCase2String($str)
    {
        if (empty($str)) {
            return $str;
        }
        // $str = str_replace('_', ' ', $str);
        // dd($str);
        $table = ucwords(str_replace('_', ' ', Str::snake(Str::singular($str))));
        return $table;
    }
}
