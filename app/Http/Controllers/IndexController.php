<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页article内容展示
     * 文章优先级
     * 1.用户感兴趣的文章
     * 2.点击量高的
     */
    public function index(){
        return view('web.index.index',['articles'=>Article::where(['is_del'=>0,'status_id'=>2])->get()]);
    }
    /**
     *首页ask内容展示
     * 1.
     */
}
