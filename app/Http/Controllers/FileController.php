<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function avatar_uploade(Request $request){
        if($request->isMethod('post')){
            $avatar = $request->file('avatar');
            if ($avatar){
                return File::store($avatar,'avatar');
            }
        }
    }
}
