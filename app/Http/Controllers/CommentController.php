<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class CommentController extends Controller
{
    /**
     * 发表评论
     */
    public function post(Request $request){
        $validateRules = [
            'content' => 'required|min:2|max:128',
        ];
        $this->validate($request,$validateRules);
        $formData = $request->all();
        $formData['post_man_id']=Auth::id();
        try{
            Comment::create($formData);
        }catch (Exception $e){

        }
        return redirect()->to('/article/getArticleById/'.$request->input('article_id'));
    }
}
