<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * 回答问题
     */
    public function answer(Request $request){

        $validateRules = [
            'content' => 'required|min:2'
        ];

        $this->validate($request,$validateRules);

        $formData = $request->all();
        $formData['post_man_id'] = Auth::id();

        Answer::create($formData);

        return redirect()->to('question/content/'.$formData['question_id']);
    }
    /**
     * 支持答案(如果答案对解决浏览者的问题有帮助，则浏览者可以支持答案)
     * user_id,answer_id
     */
    public function work_for_me(Request $request){
        $user_id = Auth::id();
        $answer_id = $request->input('answer_id');

        //判断用户之前有没有支持过这个答案
        try{
            $helped_us = Answer::where('id',$answer_id)->get(['helped_us']);
            $array_helped_us = json_decode($helped_us[0],true);
            $array_user_ids = json_decode($array_helped_us['helped_us'],true);
        }catch (Exception $e){

        }

        if (array_has($array_user_ids,'user'.$user_id)){//如果此用户支持过此答案
             array_forget($array_user_ids,'user'.$user_id);
        }else if (!$array_user_ids){ //没有用户支持过
            $array_user_ids = ['user'.$user_id=>$user_id];
        }else{                      //已有用户支持过，但验证用户没有
            $array_user_ids = array_merge($array_user_ids,['user'.$user_id=>$user_id]);
        }

        try{
            Answer::where('id',$answer_id)->update([
                'helped_us'=>json_encode($array_user_ids),
                'helped_men_num'=>sizeof($array_user_ids)
            ]);
        }catch (\Exception $e){
            return null;
        }

        return ['helped_men_num'=>sizeof($array_user_ids)];

    }
}
