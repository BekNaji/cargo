<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class Helper
{
    public static function selectOne($target,$item)
    {
        if($target == $item)
        {
            return true;
        }
        return false;
    }
}