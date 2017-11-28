<?php

namespace App\Http\Controllers;

use App\Question;
use App\Sameask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //提出问题
    public function ask(Request $request){
        if ($request->isMethod('post')){
            $validateRules = [
                'title' => 'required|min:2|max:128',
                'content' => 'required|min:6',
            ];
            $this->validate($request,$validateRules);

            $formData = $request->all();
            $formData['post_man_id']=Auth::id();

            $question = Question::create($formData);

            return redirect()->to('question/content/'.$question->id);

        }else{
            $mygroup = Auth::user()->groups;
            return view('web.question.post',['groups'=>$mygroup]);
        }
    }
    //查看问题详情
    public function getContent($id){
        $question = Question::find($id);
        $answers = $question->answers()->orderBy('helped_men_num','desc')->get();
        return view('web.question.content.index',['question'=>$question,'answers'=>$answers]);

    }
    //查看问题列表
    public function getList($column){
        return view('web.question.list.index',['questions'=>Question::orderBy($column,'desc')->get()]);
    }

    //同问
    public function same_ask(Request $request){
        $formData['question_id'] = $request->input('question_id');
        $formData['user_id'] = Auth::id();
        try {
            Sameask::create($formData);
            Question::where('id',$formData['question_id'])->increment('same_ask');
            $num = Question::where('id',$formData['question_id'])->get(['same_ask']);
            return ['msg'=>$num[0]['same_ask']];
        }catch (\Exception $e){
            return ['msg'=>'您已经问过了'];
        }
    }
}
