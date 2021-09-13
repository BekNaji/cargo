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

    public static function str_hide($username = "") {
        $replaced = "";
        
        # Count the characters in username and remove an extra asterik (*)
        # Substring, remove all characters and leave the first one and add the last one
        for($i = 0; $i < strlen($username) -1; $i++) $replaced .= "*";
    
        return substr($username, 0, 3)."".$replaced."".substr($username, -1, 1);
    }
}