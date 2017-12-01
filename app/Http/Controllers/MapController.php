<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class MapController extends Controller
{
    //用户打开或关闭附近的功能
    public function open_or_close(){
        $user = Auth::user();
        User::where('id',$user->id)->update(['is_show_location'=>!$user->is_show_location]);

        if (!User::find($user->id)->is_show_location){//若用户已关闭，则需要将其地理位置信息删除掉
            Redis::ZREM('user_ids',$user->id);
        }
        return redirect()->to('/');
    }

    //记录用户地理位置
    public function get_user_location(Request $request){
        $lng = $request->input('lng');
        $lat = $request->input('lat');
        Redis::geoadd('user_ids',$lng,$lat,Auth::id());
    }

    //寻找十公里以内的用户
    public function find_nearby(){
        $user_ids = Redis::GEORADIUSBYMEMBER('user_ids',Auth::id(),10,'km');
        $users = array();
        foreach ($user_ids as $user_id){
            array_push( $users , User::find($user_id) );
        }
        return $users;
    }
}
