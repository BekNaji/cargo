<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class CFile
{
    public static function upload($file,$path)
    {
        $imagename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path($path),$imagename);
        return $path.$imagename;
    }

    public static function delete($file)
    {
        
        if($file && file_exists(public_path($file))){
            return unlink(public_path($file));
        }
        return true;
    }
}