<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ArticleController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    private function getFormData($req){
        $validateRules = [
            'title' => 'required|min:2|max:128',
            'content' => 'required|min:6'
        ];
        $this->validate($req,$validateRules);
        $formData = $req->all();
        $formData['post_man_id'] = Auth::id();
        $formData['created_at']=$formData['updated_at']=date('Y-m-d H:i:s',time());
        $formData['status_id'] = 2;
        return $formData;
    }
    /**发表文章
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post(Request $request){
        if ($request->isMethod('post')){
//            $validateRules = [
//                'title' => 'required|min:2|max:128',
//                'content' => 'required|min:6'
//            ];
//            $this->validate($request,$validateRules);
//            $formData = $request->all();
//            $formData['post_man_id'] = Auth::id();
//            $formData['status_id'] = 2;
//            $formData['created_at']=$formData['updated_at']=date('Y-m-d H:i:s',time());
            $formData = $this->getFormData($request);
            if ($formData['id']==null){
                $article = Article::create($formData);
                return redirect()->to('/article/getArticleById/'.$article->id);
            }
            else{
                array_forget($formData,'_token');
                Article::where('id',$formData['id'])->update($formData);
                return redirect()->to('/article/getArticleById/'.$formData["id"]);
            }
        }else{
            $mygroup = Auth::user()->groups;
            return view('web.article.post',['groups'=>$mygroup]);
        }
    }
    /**更新文章
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateArticle(Request $request){
        $id = $request->input('id');
        if ($request->isMethod('post')){
//            $validateRules = [
//                'title' => 'required|min:2|max:128',
//                'content' => 'required|min:6'
//            ];
//            $this->validate($request,$validateRules);
//            $formData = $request->all();
//            $formData['post_man_id'] = Auth::id();
//            $formData['status_id'] = 2;
//            $formData['created_at']=$formData['updated_at']=date('Y-m-d H:i:s',time());
            $formData = $this->getFormData($request);
            array_forget($formData,'_token');
            try{
                Article::where('id',$id)->update($formData);
                return redirect()->to('/article/getArticleById/'.$formData["id"]);
            }catch (Exception $e){

            }
        }else{
            $mygroup = Auth::user()->groups;
            return view('web.article.update',['article'=>Article::find($id),'groups'=>$mygroup]);
        }
    }
    /**
     *自动保存文章
     */
    public function autosave(Request $request){
        if ($request->isMethod('post')){
            $validateRules = [
                'title' => 'required|min:2|max:128',
                'content' => 'required|min:6'
            ];
            $this->validate($request,$validateRules);
            $formData = $request->all();
            $formData['post_man_id'] = Auth::id();
            $formData['status_id'] = 1;
            $formData['created_at']=$formData['updated_at']=date('Y-m-d H:i:s',time());
            try{
                if (!array_has($formData,'id')){
                    $article = Article::create($formData);
                    return ['articleid' => $article->id];
                }
                else{
                    Article::where('id',$formData['id'])->update($formData);
                    return ['articleid' => $formData['id']];
                }
            }catch (Exception $e){

            }
        }else{
            return;
        }
    }

    public function getArticleListByUser($user_id){
        $author = User::find($user_id)->name;
        if (Auth::id()==$user_id)//相等说明用户正在查阅自己的文章列表
            $articles = Article::where('post_man_id',$user_id)->get();
        else
            $articles = Article::where(['post_man_id'=>$user_id,'status_id'=>2,'is_del'=>0])->get();
        $articleList = [];
        foreach ($articles as $a){
            $a->author=$author;
            array_push($articleList,$a);
        }
        return view('web.article.list',['articleList'=>$articleList]);
    }

    /**
     * 获取文章
     */
    public function getArticleById($id){
        return view('web.article.content',['article'=>Article::find($id),'comments'=>Article::find($id)->comments]);
    }

    public function add_help_num(Request $request){
        Article::where('id',$request->input('article_id'))->increment('help_number');
        return Article::where('id',$request->input('article_id'))->get(['help_number']);
    }

    public function delete(Request $request){
        Article::where('id',$request->input('id'))->update(['is_del'=>2]);
        return redirect()->to('/user/center/'.Auth::id().'/article');
    }
}
