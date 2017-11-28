<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    public static function store($file,$driver){
        $realExtension = $file->getClientOriginalExtension();
        if ($file->isValid()){
            $realPat = $file->getRealPath();
            $filename = date('y-m-d',time()).'/'.md5(time()).'.'.$realExtension;
            if ( Storage::disk($driver)->put($filename,file_get_contents($realPat)) ){
                return $driver.'/'.$filename;
            }
        }
    }
}
