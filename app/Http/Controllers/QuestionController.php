<?php

namespace App\Http\Controllers;

use App\Question;
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
        $answers = $question->answers;

        return view('web.question.content.index',['question'=>$question,'answers'=>$answers]);

    }
    //查看问题列表
    public function getList(){
        return view('web.question.list.index',['questions'=>Question::get()]);
    }
}
